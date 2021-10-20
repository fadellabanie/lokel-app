<div wire:ignore.self class="modal fade" tabindex="-1" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $editMode ? __("Update Roles") : __("Create Roles")}}</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <x-label class="required">{{__("Name")}}</x-label>
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
                    <x-label>
                        <span class="required">{{__("Permission")}}</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                            title="Phone number must be active"></i>
                    </x-label>
                    <div class="col-lg-8 fv-row">
                        <div wire:ignore>
                            <select data-control="select2" wire:model="permission_ids" id="permission_ids" name="permission_ids" 
                                class="form-select form-select-solid form-select-lg fw-bold" multiple="multiple">
                                @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}" @if(is_array($oldPermissionsIds) &&
                                    in_array($permission->id,$oldPermissionsIds)) selected
                                    @endif>{{$permission->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-error field="permission_ids" />
                    </div>
                </div>
                <!--end::Input group-->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{__("Close")}}</button>
                <button type="button" class="btn btn-primary" wire:loading.attr="disabled"
                    wire:loading.class="spinner spinner-white spinner-left"
                    wire:click.prevent="{{ $editMode ? 'update' : 'store'}}">{{__("Save")}}</button>
            </div>
        </div>
    </div>
</div>