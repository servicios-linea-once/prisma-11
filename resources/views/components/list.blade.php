@props([
    'ordered' => false,
    'icons' => false,
])

@if($ordered)
    <ol {{ $attributes->merge(['class' => 'space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400']) }}>
        {{ $slot }}
    </ol>
@else
    <ul {{ $attributes->merge(['class' => 'space-y-1 text-gray-500 ' . ($icons ? '' : 'list-disc list-inside') . ' dark:text-gray-400']) }}>
        {{ $slot }}
    </ul>
@endif
