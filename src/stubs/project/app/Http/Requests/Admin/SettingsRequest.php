<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class SettingsRequest extends FormRequest
{

    private $mergeReturn = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $chSite = app()->make('Site');
        $rules = [
            'testing' => 'boolean',
            'seo' => 'boolean',
            'addr.fname' => ['nullable', 'max:255'],
            'addr.lname' => ['nullable', 'max:255'],
            'addr.email' => ['nullable', 'email'],
            'addr.company' => ['nullable', 'max:255'],
            'addr.phone' => ['nullable', 'max:255'],
            'addr.orgnum' => ['nullable', 'max:255'],
            'addr.city' => ['nullable', 'max:255'],
            'addr.postcode' => ['nullable', 'max:255'],
            'addr.street' => ['nullable', 'max:255'],
            'addr.country' => ['nullable', 'max:255'],
            'logo' => ['nullable',  function($attribute, $value, $fail) use ($chSite) {
                $type = 'logo';
                $inputName = "settings[{$type}]";
                $attachIds = array();
                foreach((array)$value as $index => $attachTypeId) {
                    $attachIds[(int)str_replace(["{$inputName}_", "{$type}_"], '', $attachTypeId) ] = $index;
                }
                $return = \App\Models\Attachment::where([
                    'attachable_id' => null,
                    'attachable_type' => null,
                    'session_id' => session()->getId(),
                    'type' => $inputName
                ])->whereIn('id', array_keys($attachIds))->get()->keyBy('id');

                $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/svg+xml', 'image/gif'];
                foreach($return as $attach) {
                    //make some additional validation - may use new rules key pictures.*, too
                    if(!in_array(
                        \Illuminate\Support\Facades\Storage::disk( $attach->disk )->mimeType($attach->getFilePath()),
                        $allowedMimeTypes
                    )) {
                        return $fail( trans('admin/settings/validation.logo.mime') );
                    }
                }
                $return = $return->union( \App\Models\Attachment::where([
                    'attachable_id' => $chSite->id,
                    'attachable_type' => get_class($chSite),
                    'session_id' => null,
                    'type' => $type
                ])->whereIn('id', array_keys($attachIds))->get()->keyBy('id') );
                //sorting
                $this->mergeReturn['logos'] = collect();
                foreach($attachIds as $attachId => $index) {
                    if(!isset($return[$attachId])) continue;
                    $this->mergeReturn['logos']->push( $return[$attachId] );
                }
            }],
            'favicon' => ['nullable',  function($attribute, $value, $fail) use ($chSite) {
                $type = 'favicon';
                $inputName = "settings[{$type}]";
                $attachIds = array();
                foreach((array)$value as $index => $attachTypeId) {
                    $attachIds[(int)str_replace(["{$inputName}_", "{$type}_"], '', $attachTypeId) ] = $index;
                }
                $return = \App\Models\Attachment::where([
                    'attachable_id' => null,
                    'attachable_type' => null,
                    'session_id' => session()->getId(),
                    'type' => $inputName
                ])->whereIn('id', array_keys($attachIds))->get()->keyBy('id');

                $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/svg+xml', 'image/gif'];
                foreach($return as $attach) {
                    //make some additional validation - may use new rules key pictures.*, too
                    if(!in_array(
                        \Illuminate\Support\Facades\Storage::disk( $attach->disk )->mimeType($attach->getFilePath()),
                        $allowedMimeTypes
                    )) {
                        return $fail( trans('admin/settings/validation.favicon.mime') );
                    }
                }
                $return = $return->union( \App\Models\Attachment::where([
                    'attachable_id' => $chSite->id,
                    'attachable_type' => get_class($chSite),
                    'session_id' => null,
                    'type' => $type
                ])->whereIn('id', array_keys($attachIds))->get()->keyBy('id') );
                //sorting
                $this->mergeReturn['favicons'] = collect();
                foreach($attachIds as $attachId => $index) {
                    if(!isset($return[$attachId])) continue;
                    $this->mergeReturn['favicons']->push( $return[$attachId] );
                }
            }]
        ];

        // @HOOK_REQUEST_RULES

        return $rules;
    }

    public function messages() {
        $return = Arr::dot((array)trans('admin/settings/validation'));

        // @HOOK_REQUEST_MESSAGES

        return $return;
    }

    public function validationData() {
        $inputBag = 'settings';
        $this->errorBag = $inputBag;
        $inputs = $this->all();
        if(!isset($inputs[$inputBag])) {
            throw new ValidationException(trans('admin/settings/validation.no_inputs') );
        }

        $inputs[$inputBag]['testing'] = isset($inputs[$inputBag]['testing']);
        $inputs[$inputBag]['seo'] = isset($inputs[$inputBag]['seo']);

        // @HOOK_REQUEST_PREPARE

        $this->replace($inputs);
        request()->replace($inputs); //global request should be replaced, too
        return $inputs[$inputBag];
    }

    public function validated($key = null, $default = null) {
        $validatedData = parent::validated($key, $default);

        // @HOOK_REQUEST_VALIDATED

        if(is_null($key)) {

            // @HOOK_REQUEST_AFTER_VALIDATED

            return array_merge($validatedData, $this->mergeReturn);
        }

        // @HOOK_REQUEST_AFTER_VALIDATED_KEY

        return $validatedData;
    }
}
