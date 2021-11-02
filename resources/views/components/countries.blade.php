<select class="form-select form-select-solid form-select-sm" wire:model="country_id">
    <option value="all">{{__("All")}}</option>
    @foreach (countries() as $country)
    <option value="{{$country->id}}">{{$country->name}}</option>
    @endforeach
</select>
