@props([
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => 0,
    'label' => null,
    'id' => null,
])

@php
    $inputId = $id ?? 'num_' . uniqid();
@endphp

<div x-data="{ count: {{ (int) $value }} }" class="max-w-xs">
    @if($label)
        <label for="{{ $inputId }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    @endif
    <div class="relative flex items-center max-w-[8rem]">
        <button
            type="button"
            @click="count = Math.max({{ $min }}, count - {{ $step }})"
            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-2.5 h-10 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none flex items-center justify-center text-gray-900 dark:text-white"
        >
            <x-prisma-icon name="minus" size="xs" />
        </button>
        <input
            type="number"
            id="{{ $inputId }}"
            x-model.number="count"
            min="{{ $min }}"
            max="{{ $max }}"
            step="{{ $step }}"
            {{ $attributes->merge(['class' => 'bg-gray-50 border-x-0 border-gray-300 h-10 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none']) }}
        />
        <button
            type="button"
            @click="count = Math.min({{ $max }}, count + {{ $step }})"
            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-2.5 h-10 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none flex items-center justify-center text-gray-900 dark:text-white"
        >
            <x-prisma-icon name="plus" size="xs" />
        </button>
    </div>
</div>
