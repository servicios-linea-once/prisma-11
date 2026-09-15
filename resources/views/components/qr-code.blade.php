@props([
    'value' => '',
    'size' => 'md',
    'title' => null,
])

@php
    $sizeClass = match($size) {
        'sm' => 'w-32 h-32',
        'lg' => 'w-64 h-64',
        default => 'w-48 h-48',
    };
@endphp

<div {{ $attributes->merge(['class' => 'p-4 bg-white border border-gray-200 rounded-lg shadow-xs dark:bg-gray-800 dark:border-gray-700 flex flex-col items-center justify-center text-center']) }}>
    @if($value)
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode($value) }}" alt="QR Code" class="{{ $sizeClass }} rounded-md mb-2" />
    @else
        <div class="{{ $sizeClass }} bg-gray-100 dark:bg-gray-700 flex items-center justify-center rounded-md mb-2">
            {{ $slot }}
        </div>
    @endif
    @if($title)
        <span class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $title }}</span>
    @endif
</div>
