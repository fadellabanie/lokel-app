<div>
    <x-alert id='alert' class="alert-success"></x-alert>

    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true"
            aria-controls="kt_account_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{__("Send notification")}}</h3>
            </div>
        </div>
        <div id="kt_account_profile_details" class="collapse show">
            <form class="form">
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <x-label class="required">{{__("Title")}}</x-label>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12 fv-row">
                                    <x-input wire:model.lazy="title" type="text" field="title"
                                        placeholder="{{__('Enter Title')}}">
                                    </x-input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <x-label class="required">{{__("Content")}}</x-label>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12 fv-row">
                                    <x-input wire:model.lazy="content" type="text" field="content"
                                        placeholder="{{__('Enter Content')}}"></x-input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <x-label>
                            <span class="required">{{__("Type")}}</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Phone number must be active"></i>
                        </x-label>
                        <div class="col-lg-8 fv-row" wire:ignore>
                            <select wire:model="type"  
                            aria-label="Select a type" data-control="select2"
                                data-placeholder="Select a type..." id="type" name="type"
                                class="form-select form-select-solid form-select-lg fw-bold @error('type') is-invalid @enderror">
                                <option value="sms">{{__("SMS")}}</option>
                                <option value="firebase-notification">{{__("Notification")}}</option>
                                <option value="email">{{__("Email")}}</option>
                            </select>
                        </div>
                        <x-error field="type" />
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <x-label>
                            <span class="required">{{__("Users")}}</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Phone number must be active"></i>
                        </x-label>
                        <div class="col-lg-8 fv-row" wire:ignore>
                            <select wire:model="user"
                            aria-label="Select a user" data-control="select2"
                                data-placeholder="Select a user..."  id="user" name="user"
                                class="form-select form-select-solid form-select-lg fw-bold @error('user') is-invalid @enderror">
                                <option>{{__("Select...")}}</option>

                                @foreach ($members as $member)
                                <option value="{{$member->id}}">{{$member->name .' -- ' .$member->mobile }}</option>
                                @endforeach


                            </select>
                        </div>
                        <x-error field="user" />
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{route('admin.notifications.index')}}"
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

            $('#user').select2({
                placeholder: '',
            }).on('change', function () {
                @this.user = $(this).val();
            });  
             $('#type').select2({
                placeholder: '',
            }).on('change', function () {
                @this.type = $(this).val();
            });
        });

    </script>
@endsection