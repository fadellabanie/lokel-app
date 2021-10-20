<div>
    <x-alert id='alert' class="alert-success"></x-alert>

    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true"
            aria-controls="kt_account_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{__("Create Admin")}}</h3>
            </div>
        </div>
        <div id="kt_account_profile_details" class="collapse show">
            <form class="form">
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <x-label class="required">{{__("UserName")}}</x-label>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12 fv-row">
                                    <x-input type="text" field="name" wire:model="name" placeholder="name" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <x-label class="required">{{__("Email")}}</x-label>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12 fv-row">
                                    <x-input type="email" field="email" wire:model="email" placeholder="Email" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <x-label>
                            <span class="required">{{__("Role")}}</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Phone number must be active"></i>
                        </x-label>
                        <div class="col-lg-8 fv-row">
                            <div wire:ignore>
                                <select wire:model="role" id="role" name="role" data-control="select2"
                                    class="form-select form-select-solid form-select-lg fw-bold">
                                    <option disable>{{__("Select...")}}</option>
                                    {{-- <option value="admin">{{__("Admin")}}</option> --}}
                                 @foreach ($roles as $role)
                                 <option value="{{$role->name}}">{{$role->name}}</option>
                                 @endforeach
                                </select>
                            </div>
                            <x-error-select field="role" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <x-label class="required">{{__("mobile")}}</x-label>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4 fv-row">
                                    <div wire:ignore>
                                        <select wire:model="country_code" data-control="select2" id="country_code"
                                            name="country_code"
                                            class="form-select form-select-solid form-select-lg fw-bold">
                                            <option disable>{{__("Select...")}}</option>
                                            <option value="SA">{{__("Saudi Arabia")}}</option>
                                        </select>
                                    </div>
                                    <x-error-select field="country_code" />
                                </div>
                                <div class="col-lg-4 fv-row">
                                    <x-input type="tel" field="mobile" wire:model="mobile" placeholder="Mobile" />
                                </div>
                                <div class="col-lg-4 fv-row">
                                    <x-input type="tel" field="whatsapp_mobile" wire:model="whatsapp_mobile"
                                        placeholder="Whatsapp Mobile" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <x-label class="required">{{__("Password")}}</x-label>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12 fv-row">
                                    <x-input type="password" field="password" wire:model="password"
                                        placeholder="Password" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <x-label>
                            <span class="required">{{__("City")}}</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Phone number must be active"></i>
                        </x-label>
                        <div class="col-lg-8 fv-row">
                            <div wire:ignore>
                                <select data-control="select2" id="city_id" name="city_id"
                                    class="form-select form-select-solid form-select-lg fw-bold">
                                    <option>{{__("Select...")}}</option>
                                    @foreach (cities() as $city)
                                    <option value="{{$city->id}}">{{$city->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-error-select field="city_id" />
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-0">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6 mt-4">{{__("Avatar")}}</label>
                        <!--begin::Label-->
                        <!--begin::Label-->
                        <div class="col-lg-8 d-flex align-items-center">
                            <div class="col-12" x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <label for="icon"
                                    class="btn btn-light btn-text-primary btn-hover-text-primary font-weight-bold btn-sm d-flex">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                        <!--begin::Svg Icon-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14"
                                                    rx="1" />
                                                <path
                                                    d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <x-input type="file" id="icon" wire:model.lazy="avatar" field="avatar"
                                        style="display:none" />
                                </label>

                                <div wire:loading wire:target="avatar">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>

                                @if($avatar)
                                <div class="symbol symbol-750 mt-5">
                                    <img alt="" src="{{ $avatar->temporaryUrl() }}" />
                                </div>
                                @endif
                            </div>
                        </div>
                        <!--begin::Label-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{route('admin.admins.index')}}"
                        class="btn btn-light btn-active-light-primary me-2">{{__("Back")}}</a>
                    <button type="button" class="btn btn-primary" wire:click.prevent="submit()"
                        wire:loading.attr="disabled"
                        wire:loading.class="spinner spinner-white spinner-left">{{__("Save")}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {

    $('#role').select2({
        placeholder: 'select..',
    }).on('change', function () {
        @this.role = $(this).val();
    });  $('#city_id').select2({
        placeholder: 'select..',
    }).on('change', function () {
        @this.city_id = $(this).val();
    });  
     $('#country_code').select2({
        placeholder: 'select..',
    }).on('change', function () {
        @this.country_code = $(this).val();
    });  
});

</script>
@endsection