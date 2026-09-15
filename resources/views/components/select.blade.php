@props([
    'label' => null,
    'id' => null,
    'helper' => null,
    'options' => [],
])

@php
    $selectId = $id ?? 'select_' . uniqid();
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $selectId }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}
        </label>
    @endif
    <select
        id="{{ $selectId }}"
        {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-pointer']) }}
    >
        @if(!empty($options))
            @foreach($options as $val => $text)
                <option value="{{ $val }}">{{ $text }}</option>
            @endforeach
        @endif
        {{ $slot }}
    </select>
    @if($helper)
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $helper }}</p>
    @endif
</div>
