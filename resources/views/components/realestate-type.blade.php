<select class="form-select form-select-solid form-select-sm" wire:model="realestate_type_id">
    <option value="all">{{__("Select Realestate Type")}}</option>
    @foreach (realestateType() as $realestateType)
    <option value="{{$realestateType->id}}">{{$realestateType->en_name}}</option>
    @endforeach
</select>
