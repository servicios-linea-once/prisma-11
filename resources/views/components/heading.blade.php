@props([
    'level' => 1,
])

@php
    $tag = 'h' . min(6, max(1, (int) $level));
    $classes = match((int) $level) {
        1 => 'text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white',
        2 => 'text-4xl font-bold tracking-tight text-gray-900 dark:text-white',
        3 => 'text-3xl font-bold text-gray-900 dark:text-white',
        4 => 'text-2xl font-bold text-gray-900 dark:text-white',
        5 => 'text-xl font-semibold text-gray-900 dark:text-white',
        default => 'text-lg font-semibold text-gray-900 dark:text-white',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</{{ $tag }}>
