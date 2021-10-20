<!--(Begin) Modal Update Or Store (Begin)-->
<div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{__("Create Permissions")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row validated">
                            <div class="col-lg-12">
                                <x-label>{{__("Arabic Name")}}</x-label>
                                <div class="col-12">
                                    <x-input wire:model.lazy="name" field='name' />
                                    <span class="form-text text-muted">{{__("Please enter name of Role")}}</span>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">{{__("Close")}}</button>

                    <button type="button" wire:click.prevent="{{ $editMode ? 'update' : 'store'}}"
                        class="btn btn-primary font-weight-bold" data-dismiss="modal">{{__("Save")}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--(End) Modal Update Or Store (End)-->