@props(['active' => false])

@php
if ($active) {            
    $attributes = $attributes->merge([
        'class' => 'nav-link active',
        'aria-current' => 'page'
    ]);
} else {
    $attributes = $attributes->merge([
        'class' => 'nav-link'
    ]);
}
@endphp

<a {{ $attributes }} 
    >
    {{ $slot }}
</a>