@props(['value'])

<label {{ $attributes->merge(['class' => 'col-lg-4 col-form-label fw-bold fs-6']) }}>
    {{ $value ?? $slot }}
</label>
