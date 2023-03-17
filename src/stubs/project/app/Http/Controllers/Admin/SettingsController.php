<?php

    namespace App\Http\Controllers\Admin;

    use App\Models\Site;
    use Illuminate\Support\Facades\View;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Str;
    use App\Http\Requests\Admin\SettingsRequest;

    class SettingsController extends Controller {

        public function __construct() {
            if(!request()->route()) return;
            $this->db_table = Site::getModel()->getTable();
            $this->routeNamespace = Str::before(request()->route()->getName(), '.settings');
            View::composer('admin/settings/*', function($view) {
                $viewData = [
                    'route_namespace' => $this->routeNamespace,
                ];
                // @HOOK_VIEW_COMPOSERS
                $view->with($viewData);
            });
            // @HOOK_CONSTRUCT
        }

        // @HOOK_METHODS

        public function index() {
            $viewData = [];
            $viewData['chSite'] = app()->make('Site');

            // @HOOK_INDEX_END

            return view('admin/settings/settings', $viewData);
        }

        public function update(SettingsRequest $request) {
            $validatedData = $request->validated();

            // @HOOK_UPDATE_VALIDATE

            $chSite = app()->make('Site');
            $chSiteAddr = $chSite->getAddress();

            $chSite->update( $validatedData );
            $chSite->setAVars($validatedData['add']?? []);
            $chSiteAddr->update( $validatedData['addr'] );
            $chSite->reAttachAndOrder( $validatedData['logos'] ?? [], 'logo' );
            $chSite->reAttachAndOrder( $validatedData['favicons'] ?? [], 'favicon' );

            // @HOOK_UPDATE_END

            event( 'settings.submited', [$chSite, $validatedData] );
            if($request->has('action')) {
                return redirect()->route($this->routeNamespace.'.settings.index')
                    ->with('message_success', trans('admin/settings/settings.updated'));
            }
            return back()->with('message_success', trans('admin/settings/settings.updated'));
        }
    }
