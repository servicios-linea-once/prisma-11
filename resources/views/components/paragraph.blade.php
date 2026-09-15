@props([
    'variant' => 'body', // 'lead', 'body', 'small'
])

@php
    $classes = match($variant) {
        'lead' => 'text-xl font-normal text-gray-500 dark:text-gray-400',
        'small' => 'text-xs text-gray-500 dark:text-gray-400',
        default => 'text-base font-normal text-gray-700 dark:text-gray-400',
    };
@endphp

<p {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</p>
