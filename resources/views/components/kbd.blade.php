@props([
    'size' => 'md',
])

@php
    $sizeClass = match($size) {
        'xs' => 'px-1.5 py-0.5 text-xs',
        'sm' => 'px-2 py-1 text-xs',
        'lg' => 'px-3 py-2 text-sm',
        default => 'px-2 py-1.5 text-xs font-semibold',
    };
@endphp

<kbd {{ $attributes->merge(['class' => "{$sizeClass} text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500 shadow-2xs font-mono"]) }}>
    {{ $slot }}
</kbd>
