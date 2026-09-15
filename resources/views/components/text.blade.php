@props([
    'variant' => 'default', // 'muted', 'highlight', 'underline', 'strike'
])

@php
    $classes = match($variant) {
        'muted' => 'text-gray-500 dark:text-gray-400',
        'highlight' => 'text-white bg-blue-600 px-1.5 py-0.5 rounded-sm',
        'underline' => 'underline decoration-blue-500 decoration-2 underline-offset-4',
        'strike' => 'line-through text-gray-500 dark:text-gray-400',
        default => 'text-gray-900 dark:text-white',
    };
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
