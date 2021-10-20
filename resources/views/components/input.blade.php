@props(['disabled' => false, 'field'])

<div class="col-12">
    <input {{ $disabled ? 'disabled' : '' }}
    {!! ($errors->has($field))
        ? $attributes->merge(['class' => "form-control form-control-l form-control-solid mb-3 mb-l-0 is-invalid"])
        : $attributes->merge(['class' => "form-control form-control-l form-control-solid mb-3 mb-l-0"]) !!} >

    <x-error field="{{ $field }}" />
</div>

