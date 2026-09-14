@php
    $iconName = $name ?? $attributes->get('name', '');
    $iconSize = $size ?? $attributes->get('size', 'md');
    $iconColor = $color ?? $attributes->get('color', 'current');

    $svg = $svgContent ?? \ServicioLineaOnce\Prisma11\Support\IconRegistry::get((string) $iconName);
    $colorClass = $iconColor === 'current' ? 'text-current' : "text-{$iconColor}";

    $iconClasses = !empty($classes) ? $classes : \ServicioLineaOnce\Prisma11\Support\TailwindClassMerge::merge(
        'inline-block shrink-0',
        \ServicioLineaOnce\Prisma11\Support\IconRegistry::sizeClasses((string) $iconSize),
        $colorClass
    );
@endphp

<svg
    {{ $attributes->except(['class', 'name', 'size', 'color'])->merge(['class' => $iconClasses]) }}
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
>
    {!! $svg !!}
</svg>
