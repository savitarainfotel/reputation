@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label mt-2']) }}>
    {{ $value ?? $slot }}
</label>