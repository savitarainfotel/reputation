@props(['disabled' => false])
<textarea
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'form-control',
        'cols' => $attributes->get('cols', 30),
        'rows' => $attributes->get('rows', 5)
    ]) }}
></textarea>