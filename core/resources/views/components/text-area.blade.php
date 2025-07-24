@props(['disabled' => false, 'value' => null, 'propertyName' => null])
<textarea @disabled($disabled) {{ $attributes->merge([
        'class' => 'form-control',
        'cols' => $attributes->get('cols', 30),
        'rows' => $attributes->get('rows', 5)
    ]) }}
>{{ $value ?? (!empty($propertyName) ? "Best Regards,\n{$propertyName}" : "") }}</textarea>