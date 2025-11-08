@props(['active'])

@php
$classes = ($active ?? false)
            ? 'sidebar-link active text-white text-decoration-none'
            : 'sidebar-link text-white text-decoration-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>