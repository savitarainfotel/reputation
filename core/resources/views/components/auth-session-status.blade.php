@props(['status'])

@if ($status)
    <strong {{ $attributes->merge(['class' => 'font-medium text-sm text-success']) }}>
        {{ $status }}
    </strong>
@endif