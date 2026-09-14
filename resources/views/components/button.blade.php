@props([
    'as' => 'button',
    'variant' => 'solid',
    'color' => 'primary',
    'size' => 'md',
    'rounded' => 'md',
    'loading' => false,
    'disabled' => false,
    'iconLeading' => null,
    'iconTrailing' => null,
    'href' => null,
    'classes' => '',
])

@php
    $finalClasses = $attributes->get('class')
        ? $component->mergeClasses($classes, $attributes->get('class'))
        : $classes;
@endphp

@if ($as === 'a' || $href)
    <a href="{{ $href }}" {{ $attributes->except('class')->merge(['class' => $finalClasses]) }}>
        @if ($loading)
            <x-prisma-spinner size="{{ $size }}" color="current" class="animate-spin -ms-1 me-2" />
        @elseif ($iconLeading)
            <x-prisma-icon name="{{ $iconLeading }}" size="{{ $size }}" class="-ms-0.5" />
        @endif

        {{ $slot }}

        @if ($iconTrailing && !$loading)
            <x-prisma-icon name="{{ $iconTrailing }}" size="{{ $size }}" class="-me-0.5" />
        @endif
    </a>
@else
    <button
        type="{{ $attributes->get('type', 'button') }}"
        {{ $attributes->except('class')->merge(['class' => $finalClasses]) }}
        @disabled($disabled || $loading)
    >
        @if ($loading)
            <x-prisma-spinner size="{{ $size }}" color="current" class="animate-spin -ms-1 me-2" />
        @elseif ($iconLeading)
            <x-prisma-icon name="{{ $iconLeading }}" size="{{ $size }}" class="-ms-0.5" />
        @endif

        {{ $slot }}

        @if ($iconTrailing && !$loading)
            <x-prisma-icon name="{{ $iconTrailing }}" size="{{ $size }}" class="-me-0.5" />
        @endif
    </button>
@endif
