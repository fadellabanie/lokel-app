
<button class="btn btn-sm btn-success m-2" wire:click.prevent="export" wire:loading.attr="disabled"
wire:loading.class="spinner spinner-white spinner-left">
    <i class="fas fa-file-excel"></i>{{__("Export")}}</button>
