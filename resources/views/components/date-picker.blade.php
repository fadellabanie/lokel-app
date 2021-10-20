@props(['field' => null])

<div
    x-data="{ value: @entangle($attributes->wire('model')), picker: undefined }"
    x-init="new Pikaday({ field: $refs.input, minDate: {{ $attributes->has('minDate') ? $attributes->get('minDate') : 'null' }} })"
    x-on:change="value = $event.target.value"
    class="col-9"
>
    <input
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-ref="input"
        x-bind:value="value"
        {!! ($errors->has($field))
        ? $attributes->merge(['class' => "form-control form-control-lg is-invalid"])
        : $attributes->merge(['class' => "form-control form-control-lg"]) !!}
        type="text"
    />

    <x-error field="{{ $field }}" />
</div>

@push('styles')
    @once
       <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    @endonce
@endpush

@push('scripts')
    @once
        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    @endonce
@endpush