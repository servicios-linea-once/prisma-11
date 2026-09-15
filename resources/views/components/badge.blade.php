@props([
    'classes' => '',
    'color' => 'primary',
    'variant' => 'solid',
    'size' => 'sm',
    'rounded' => 'full',
])

@php
    $resolved = \ServicioLineaOnce\Prisma11\Support\ComponentModifiers::resolve($attributes, [
        'color' => $color === 'primary' ? null : $color,
        'size' => $size === 'sm' ? null : $size,
        'variant' => $variant === 'solid' ? null : $variant,
        'pill' => $rounded === 'full',
        'defaultColor' => 'primary',
        'defaultSize' => 'sm',
        'defaultVariant' => 'solid',
    ]);
    $color = $resolved['color'];
    $size = $resolved['size'];
    $variant = $resolved['variant'];
    $rounded = $resolved['pill'] ? 'full' : ($rounded ?? 'full');
    $attributes = $resolved['attributes'];

    $computedClasses = isset($component) && method_exists($component, 'computeClasses')
        ? $component->computeClasses($color, $size, $variant, $rounded)
        : $classes;

    $finalClasses = $attributes->get('class')
        ? (isset($component) ? $component->mergeClasses($computedClasses, $attributes->get('class')) : "{$computedClasses} " . $attributes->get('class'))
        : $computedClasses;
@endphp

<span {{ $attributes->except('class')->merge(['class' => $finalClasses]) }}>
    @if ($variant === 'dot')
        <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }} -ms-0.5" aria-hidden="true"></span>
    @endif
    {{ $slot }}
</span>
