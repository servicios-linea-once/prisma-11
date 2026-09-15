@props([
    'color' => 'blue',
    'size' => 'md',
    'ping' => false,
    'placement' => null,
])

@php
    $colorClass = match($color) {
        'red', 'danger' => 'bg-red-500',
        'green', 'success' => 'bg-green-500',
        'yellow', 'warning' => 'bg-yellow-400',
        'gray', 'dark' => 'bg-gray-500',
        'purple' => 'bg-purple-500',
        default => 'bg-blue-600',
    };

    $sizeClass = match($size) {
        'xs' => 'w-2 h-2',
        'sm' => 'w-2.5 h-2.5',
        'lg' => 'w-3.5 h-3.5',
        'xl' => 'w-4 h-4',
        default => 'w-3 h-3',
    };

    $placementClass = match($placement) {
        'top-right' => 'absolute top-0 right-0 -mt-1 -mr-1',
        'top-left' => 'absolute top-0 left-0 -mt-1 -ml-1',
        'bottom-right' => 'absolute bottom-0 right-0 -mb-1 -mr-1',
        'bottom-left' => 'absolute bottom-0 left-0 -mb-1 -ml-1',
        default => 'inline-block',
    };
@endphp

<span class="relative inline-flex {{ $placementClass }}">
    @if($ping)
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $colorClass }} opacity-75"></span>
    @endif
    <span {{ $attributes->merge(['class' => "relative inline-flex rounded-full {$sizeClass} {$colorClass}"]) }}>
        {{ $slot }}
    </span>
</span>
