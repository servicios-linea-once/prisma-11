@props([
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'label' => null,
    'id' => null,
    'showValues' => false,
])

@php
    $rangeId = $id ?? 'range_' . uniqid();
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $rangeId }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}
        </label>
    @endif
    <input
        id="{{ $rangeId }}"
        type="range"
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        {{ $attributes->merge(['class' => 'w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 accent-blue-600']) }}
    />
    @if($showValues)
        <span class="text-xs text-gray-500 dark:text-gray-400 flex justify-between mt-1">
            <span>{{ $min }}</span>
            <span>{{ $max }}</span>
        </span>
    @endif
</div>
