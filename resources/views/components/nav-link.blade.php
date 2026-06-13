@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 text-sm font-medium text-primary-700 bg-primary-50 rounded-lg transition'
            : 'inline-flex items-center px-3 py-2 text-sm font-medium text-dark-500 hover:text-dark-800 hover:bg-dark-100 rounded-lg transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
