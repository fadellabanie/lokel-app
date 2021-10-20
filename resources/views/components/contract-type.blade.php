<select class="form-select form-select-solid form-select-sm" wire:model="contract_type_id">
    <option value="all">{{__("Select Contract Type")}}</option>
    @foreach (contractTypes() as $contractType)
    <option value="{{$contractType->id}}">{{$contractType->en_name}}</option>
    @endforeach
</select>
