<select class="form-select form-select-solid form-select-sm" wire:model="city_id">
    <option value="all">{{__("All")}}</option>
    @foreach (cities() as $city)
    <option value="{{$city->id}}">{{$city->name}}</option>
    @endforeach
</select>
