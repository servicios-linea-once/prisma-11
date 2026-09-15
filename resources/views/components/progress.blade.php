@props([
    'value' => 0,
    'color' => null,
    'size' => null,
    'label' => null,
    'showPercent' => false,
])

@php
    $resolved = \ServicioLineaOnce\Prisma11\Support\ComponentModifiers::resolve($attributes, [
        'color' => $color,
        'size' => $size,
        'defaultColor' => 'primary',
        'defaultSize' => 'md',
    ]);
    $color = $resolved['color'];
    $size = $resolved['size'];
    $attributes = $resolved['attributes'];

    $colorClass = match($color) {
        'green', 'success' => 'bg-green-600',
        'red', 'danger' => 'bg-red-600',
        'yellow', 'warning' => 'bg-yellow-400',
        'purple' => 'bg-purple-600',
        'dark', 'gray' => 'bg-gray-600',
        default => 'bg-primary',
    };

    $sizeClass = match($size) {
        'xs' => 'h-1',
        'sm' => 'h-1.5',
        'lg' => 'h-4',
        'xl' => 'h-6',
        default => 'h-2.5',
    };
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if($label || $showPercent)
        <div class="flex justify-between mb-1">
            @if($label)
                <span class="text-sm font-medium text-gray-700 dark:text-white">{{ $label }}</span>
            @endif
            @if($showPercent)
                <span class="text-sm font-medium text-gray-700 dark:text-white">{{ $value }}%</span>
            @endif
        </div>
    @endif
    <div class="w-full bg-gray-200 rounded-full {{ $sizeClass }} dark:bg-gray-700 overflow-hidden">
        <div class="{{ $colorClass }} {{ $sizeClass }} rounded-full transition-all duration-300" style="width: {{ min(100, max(0, (int) $value)) }}%"></div>
    </div>
</div>
