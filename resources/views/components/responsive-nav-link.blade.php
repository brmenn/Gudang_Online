@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center w-full px-3 py-2 text-sm font-medium text-primary-700 bg-primary-50 rounded-lg transition'
            : 'flex items-center w-full px-3 py-2 text-sm font-medium text-dark-600 hover:text-dark-800 hover:bg-dark-100 rounded-lg transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
