@props([
    'label' => null,
    'id' => null,
    'placeholder' => 'Selecciona fecha',
])

@php
    $pickerId = $id ?? 'date_' . uniqid();
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $pickerId }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    @endif
    <div class="relative max-w-sm">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-500 dark:text-gray-400">
            <x-prisma-icon name="calendar" size="sm" />
        </div>
        <input
            type="date"
            id="{{ $pickerId }}"
            {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}
            placeholder="{{ $placeholder }}"
        />
    </div>
</div>
