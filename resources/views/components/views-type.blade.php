<select class="form-select form-select-solid form-select-sm" wire:model="view_id">
    <option value="all">{{__("Select View")}}</option>
    @foreach (viewTypes() as $view)
    <option value="{{$view->id}}">{{$view->en_name}}</option>
    @endforeach
</select>
