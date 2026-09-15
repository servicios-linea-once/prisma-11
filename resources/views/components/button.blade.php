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
    $resolved = \ServicioLineaOnce\Prisma11\Support\ComponentModifiers::resolve($attributes, [
        'color' => $color === 'primary' ? null : $color,
        'size' => $size === 'md' ? null : $size,
        'variant' => $variant === 'solid' ? null : $variant,
        'pill' => $rounded === 'full',
        'defaultColor' => 'primary',
        'defaultSize' => 'md',
        'defaultVariant' => 'solid',
    ]);
    $color = $resolved['color'];
    $size = $resolved['size'];
    $variant = $resolved['variant'];
    $rounded = $resolved['pill'] ? 'full' : ($rounded ?? 'md');
    $attributes = $resolved['attributes'];

    $computedClasses = isset($component) && method_exists($component, 'computeClasses')
        ? $component->computeClasses($color, $size, $variant, $rounded)
        : $classes;

    $finalClasses = $attributes->get('class')
        ? (isset($component) ? $component->mergeClasses($computedClasses, $attributes->get('class')) : "{$computedClasses} " . $attributes->get('class'))
        : $computedClasses;
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
