@props(['active'])

@php
$classes = ($active ?? false)
            ? 'col-2 bottom-navbar-link active text-center text-white text-decoration-none'
            : 'col-2 bottom-navbar-link text-center text-white text-decoration-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>