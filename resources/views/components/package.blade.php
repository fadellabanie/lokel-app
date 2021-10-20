<select class="form-select form-select-solid form-select-sm" wire:model="package_id">
    <option value="all">{{__("All")}}</option>
    @foreach (packages() as $package)
    <option value="{{$package->id}}">{{$package->en_name}}</option>
    @endforeach
</select>
