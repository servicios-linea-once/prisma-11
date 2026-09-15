@php
    $rawName = (string) ($name ?? $attributes->get('name', ''));
    $resolvedIcon = $iconName ?? \ServicioLineaOnce\Prisma11\Support\IconRegistry::resolveIconName($rawName);
    $driver = (string) config('prisma.icons.driver', 'iconify');
    $iconSize = (string) ($size ?? $attributes->get('size', 'md'));
    $iconColor = (string) ($color ?? $attributes->get('color', 'current'));
    $iconFlip = $flip ?? $attributes->get('flip');
    $iconRotate = $rotate ?? $attributes->get('rotate');

    $colorClass = $iconColor === 'current' ? 'text-current' : "text-{$iconColor}";

    $iconClasses = !empty($classes) ? $classes : \ServicioLineaOnce\Prisma11\Support\TailwindClassMerge::merge(
        'inline-block shrink-0 align-middle',
        \ServicioLineaOnce\Prisma11\Support\IconRegistry::sizeClasses($iconSize),
        $colorClass
    );

    $svg = $svgContent ?? \ServicioLineaOnce\Prisma11\Support\IconRegistry::get($rawName);
@endphp

@if($driver === 'iconify')
    <iconify-icon
        icon="{{ $resolvedIcon }}"
        {{ $attributes->except(['class', 'name', 'size', 'color', 'flip', 'rotate'])->merge(['class' => $iconClasses]) }}
        @if(!empty($iconFlip)) flip="{{ $iconFlip }}" @endif
        @if(!empty($iconRotate)) rotate="{{ $iconRotate }}" @endif
        aria-hidden="true"
    ></iconify-icon>
@else
    <svg
        {{ $attributes->except(['class', 'name', 'size', 'color', 'flip', 'rotate'])->merge(['class' => $iconClasses]) }}
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
@endif
