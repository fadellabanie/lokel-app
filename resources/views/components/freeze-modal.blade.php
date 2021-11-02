<div wire:ignore.self class="modal fade freezeModal" id="freezeModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="freezeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="freezeModalLabel">{{ __("Confirm Freeze") }}</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('Blocked at')}}</label>
                        <div class="col-lg-12 col-xl-12">
                            <x-input type="date" wire:model="block_date" field="block_date" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a wire:click="freeze()" class="mr-2 btn btn-danger font-weight-bold">{{ __("Freeze") }}</a>
                <a class="btn btn-dark font-weight-bold" data-bs-dismiss="modal">{{ __("Close") }}</a>
            </div>
        </div>
    </div>
</div>