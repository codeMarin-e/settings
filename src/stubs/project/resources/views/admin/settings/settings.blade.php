@php $inputBag = 'settings'; @endphp
{{-- @HOOK_SCRIPTS --}}
<x-admin.main>
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("{$route_namespace}.home")}}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item active">@lang('admin/settings/settings.label')</li>
        </ol>

        <div class="card">
            <div class="card-body">
                <form action="{{ route("{$route_namespace}.settings.update") }}"
                      method="POST"
                      autocomplete="off"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <x-admin.box_messages />

                    <x-admin.box_errors :inputBag="$inputBag" />

                    {{-- @HOOK_BEGINING --}}

                    <div class="row">
                        <div class="col-lg-3">
                            <x-admin.filepond
                                translations="admin/settings/settings.logo"
                                :routeNamespace="$route_namespace"
                                type="logo"
                                :inputBag="$inputBag"
                                :accept="'[\'image/*\']'"
                                maxFileSize="1MB"
                                :multiple="false"
                                :attachable="$chSite?? null"
                                :querySelectorID="'logo'"
                                width="100%"
                            />
                        </div>
                        <div class="col-lg-3">
                            <x-admin.filepond
                                translations="admin/settings/settings.favicon"
                                :routeNamespace="$route_namespace"
                                type="favicon"
                                :inputBag="$inputBag"
                                :accept="'[\'image/*\']'"
                                maxFileSize="1MB"
                                :multiple="false"
                                :attachable="$chSite?? null"
                                :querySelectorID="'favicon'"
                                width="100%"
                            />
                        </div>
                    </div>
                    {{-- @HOOK_AFTER_PICTURES --}}

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row"
                                         id="company_fieldset">
                                        <div class="col-lg-4">
                                            <label for="{{$inputBag}}[addr][company]"
                                                   class="col-form-label"
                                            >@lang('admin/settings/settings.addr.company')</label>
                                            <input type="text"
                                                   name="{{$inputBag}}[addr][company]"
                                                   id="{{$inputBag}}[addr][company]"
                                                   value="{{ old("{$inputBag}.addr.company", (isset($chSite)? $chSite->address->company: '')) }}"
                                                   onkeyup="this.classList.remove('is-invalid')"
                                                   class="form-control @if($errors->$inputBag->has('addr.company')) is-invalid @endif"
                                            />
                                        </div>
                                        {{-- @HOOK_AFTER_COMPANY --}}

                                        <div class="col-lg-4">
                                            <label for="{{$inputBag}}[addr][orgnum]"
                                                   class="col-form-label"
                                            >@lang('admin/settings/settings.addr.orgnum')</label>
                                            <input type="text"
                                                   name="{{$inputBag}}[addr][orgnum]"
                                                   id="{{$inputBag}}[addr][orgnum]"
                                                   value="{{ old("{$inputBag}.addr.orgnum", (isset($chSite)? $chSite->address->orgnum: '')) }}"
                                                   onkeyup="this.classList.remove('is-invalid')"
                                                   class="form-control @if($errors->$inputBag->has('addr.orgnum')) is-invalid @endif"
                                            />
                                        </div>
                                        {{-- @HOOK_AFTER_ORGNUM --}}

                                    </div>
                                    {{-- @HOOK_AFTER_ADDR_GROUP_1 --}}

                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label for="{{$inputBag}}[addr][fname]"
                                                   class="col-form-label"
                                            >@lang('admin/settings/settings.addr.fname')</label>
                                            <input type="text"
                                                   name="{{$inputBag}}[addr][fname]"
                                                   id="{{$inputBag}}[addr][fname]"
                                                   value="{{ old("{$inputBag}.addr.fname", (isset($chSite)? $chSite->address->fname: '')) }}"
                                                   onkeyup="this.classList.remove('is-invalid')"
                                                   class="form-control @if($errors->$inputBag->has('addr.fname')) is-invalid @endif"
                                            />
                                        </div>
                                        {{-- @HOOK_AFTER_FNAME --}}

                                        <div class="col-lg-4">
                                            <label for="{{$inputBag}}[addr][lname]"
                                                   class="col-form-label"
                                            >@lang('admin/settings/settings.addr.lname')</label>
                                            <input type="text"
                                                   name="{{$inputBag}}[addr][lname]"
                                                   id="{{$inputBag}}[addr][lname]"
                                                   value="{{ old("{$inputBag}.addr.lname", (isset($chSite)? $chSite->address->lname: '')) }}"
                                                   onkeyup="this.classList.remove('is-invalid')"
                                                   class="form-control @if($errors->$inputBag->has('addr.lname')) is-invalid @endif"
                                            />
                                        </div>
                                        {{-- @HOOK_AFTER_LNAME --}}

                                        <div class="col-lg-4">
                                            <label for="{{$inputBag}}[addr][email]"
                                                   class="col-form-label"
                                            >@lang('admin/settings/settings.addr.email')</label>
                                            <input type="text"
                                                   name="{{$inputBag}}[addr][email]"
                                                   id="{{$inputBag}}[addr][email]"
                                                   value="{{ old("{$inputBag}.addr.email", (isset($chSite)? $chSite->address->email: '')) }}"
                                                   onkeyup="this.classList.remove('is-invalid')"
                                                   class="form-control @if($errors->$inputBag->has('addr.email')) is-invalid @endif"
                                            />
                                        </div>
                                        {{-- @HOOK_AFTER_EMAIL --}}
                                    </div>
                                    {{-- @HOOK_AFTER_ADDR_GROUP_2 --}}

                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label for="{{$inputBag}}[addr][phone]"
                                                   class="col-form-label"
                                            >@lang('admin/settings/settings.addr.phone')</label>
                                            <input type="text"
                                                   name="{{$inputBag}}[addr][phone]"
                                                   id="{{$inputBag}}[addr][phone]"
                                                   value="{{ old("{$inputBag}.addr.phone", (isset($chSite)? $chSite->address->phone: '')) }}"
                                                   onkeyup="this.classList.remove('is-invalid')"
                                                   class="form-control @if($errors->$inputBag->has('addr.phone')) is-invalid @endif"
                                            />
                                        </div>
                                        {{-- @HOOK_AFTER_PHONE --}}

                                        <div class="col-lg-4">
                                            <label for="{{$inputBag}}[addr][postcode]"
                                                   class="col-form-label"
                                            >@lang('admin/settings/settings.addr.postcode')</label>
                                            <input type="text"
                                                   name="{{$inputBag}}[addr][postcode]"
                                                   id="{{$inputBag}}[addr][postcode]"
                                                   value="{{ old("{$inputBag}.addr.postcode", (isset($chSite)? $chSite->address->postcode: '')) }}"
                                                   onkeyup="this.classList.remove('is-invalid')"
                                                   class="form-control @if($errors->$inputBag->has('addr.postcode')) is-invalid @endif"
                                            />
                                        </div>
                                        {{-- @HOOK_AFTER_POSTCODE --}}

                                        <div class="col-lg-4">
                                            <label for="{{$inputBag}}[addr][city]"
                                                   class="col-form-label"
                                            >@lang('admin/settings/settings.addr.city')</label>
                                            <input type="text"
                                                   name="{{$inputBag}}[addr][city]"
                                                   id="{{$inputBag}}[addr][city]"
                                                   value="{{ old("{$inputBag}.addr.city", (isset($chSite)? $chSite->address->city: '')) }}"
                                                   onkeyup="this.classList.remove('is-invalid')"
                                                   class="form-control @if($errors->$inputBag->has('addr.city')) is-invalid @endif"
                                            />
                                        </div>
                                        {{-- @HOOK_AFTER_CITY --}}

                                    </div>
                                    {{-- @HOOK_AFTER_ADDR_GROUP_3 --}}

                                    <div class="form-group row">
                                        <div class="col-lg-8">
                                            <label for="{{$inputBag}}[addr][street]"
                                                   class="col-form-label"
                                            >@lang('admin/settings/settings.addr.street')</label>
                                            <input type="text"
                                                   name="{{$inputBag}}[addr][street]"
                                                   id="{{$inputBag}}[addr][street]"
                                                   value="{{ old("{$inputBag}.addr.street", (isset($chSite)? $chSite->address->street: '')) }}"
                                                   onkeyup="this.classList.remove('is-invalid')"
                                                   class="form-control @if($errors->$inputBag->has('addr.street')) is-invalid @endif"
                                            />
                                        </div>
                                        {{-- @HOOK_AFTER_STREET --}}

                                        <div class="col-lg-4">
                                            <label for="{{$inputBag}}[addr][country]"
                                                   class="col-form-label"
                                            >@lang('admin/settings/settings.addr.country')</label>
                                            <input type="text"
                                                   name="{{$inputBag}}[addr][country]"
                                                   id="{{$inputBag}}[addr][country]"
                                                   value="{{ old("{$inputBag}.addr.country", (isset($chSite)? $chSite->address->country: '')) }}"
                                                   onkeyup="this.classList.remove('is-invalid')"
                                                   class="form-control @if($errors->$inputBag->has('addr.country')) is-invalid @endif"
                                            />
                                        </div>
                                        {{-- @HOOK_AFTER_COUNTRY --}}

                                    </div>
                                    {{-- @HOOK_AFTER_ADDR_GROUP_4 --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- @HOOK_AFTER_ADDRESS --}}

                    <div class="form-group row form-check">
                        <div class="col-lg-6">
                            <input type="checkbox"
                                   value="1"
                                   id="{{$inputBag}}[seo]"
                                   name="{{$inputBag}}[seo]"
                                   class="form-check-input @if($errors->$inputBag->has('seo'))is-invalid @endif"
                                   @if(old("{$inputBag}.seo") || (is_null(old("{$inputBag}.seo")) && isset($chSite) && $chSite->seo ))checked="checked"@endif
                            />
                            <label class="form-check-label"
                                   for="{{$inputBag}}[seo]">@lang('admin/settings/settings.seo')</label>
                        </div>
                    </div>
                    {{-- @HOOK_AFTER_SEO --}}

                    <div class="form-group row form-check">
                        <div class="col-lg-6">
                            <input type="checkbox"
                                   value="1"
                                   id="{{$inputBag}}[testing]"
                                   name="{{$inputBag}}[testing]"
                                   class="form-check-input @if($errors->$inputBag->has('testing'))is-invalid @endif"
                                   @if(old("{$inputBag}.testing") || (is_null(old("{$inputBag}.testing")) && isset($chSite) && $chSite->testing ))checked="checked"@endif
                            />
                            <label class="form-check-label"
                                   for="{{$inputBag}}[testing]">@lang('admin/settings/settings.testing')</label>
                        </div>
                    </div>
                    {{-- @HOOK_AFTER_TESTING --}}


                    @can('settings_update')
                        <div class="form-group row">
                            <button class='btn btn-success mr-2'
                                    type='submit'
                                    name='action'>@lang('admin/settings/settings.save')
                            </button>
                        </div>
                    @endcan
                </form>

            </div>
        </div>
    </div>
</x-admin.main>
