@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-4 py-2 rounded-full
       bg-emerald-100 text-emerald-700 font-semibold'
    : 'inline-flex items-center px-4 py-2 rounded-full
       text-gray-600 hover:text-emerald-600 hover:bg-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
