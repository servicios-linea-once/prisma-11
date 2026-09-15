@props([
    'label' => null,
    'id' => null,
    'format' => '24h', // 12h or 24h
])

@php
    $pickerId = $id ?? 'time_' . uniqid();
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $pickerId }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    @endif
    <div class="relative">
        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none text-gray-500 dark:text-gray-400">
            <x-prisma-icon name="clock" size="sm" />
        </div>
        <input
            type="time"
            id="{{ $pickerId }}"
            {{ $attributes->merge(['class' => 'bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}
        />
    </div>
</div>
