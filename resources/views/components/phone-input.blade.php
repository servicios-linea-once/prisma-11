@props([
    'label' => null,
    'id' => null,
    'defaultCountry' => '+1',
])

@php
    $inputId = $id ?? 'phone_' . uniqid();
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $inputId }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}
        </label>
    @endif
    <div class="flex items-center">
        <select class="shrink-0 z-10 inline-flex items-center py-2.5 px-3 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">
            <option value="+1">🇺🇸 +1</option>
            <option value="+34">🇪🇸 +34</option>
            <option value="+52">🇲🇽 +52</option>
            <option value="+57" selected>🇨🇴 +57</option>
            <option value="+54">🇦🇷 +54</option>
            <option value="+56">🇨🇱 +56</option>
            <option value="+51">🇵🇪 +51</option>
        </select>
        <div class="relative w-full">
            <input
                type="tel"
                id="{{ $inputId }}"
                {{ $attributes->merge(['class' => 'block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500']) }}
                placeholder="123-456-7890"
            />
        </div>
    </div>
</div>
