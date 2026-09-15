@props([
    'cols' => 3,
])

@php
    $colsClass = match((int) $cols) {
        2 => 'grid-cols-2',
        4 => 'grid-cols-2 md:grid-cols-4',
        default => 'grid-cols-2 md:grid-cols-3',
    };
@endphp

<div {{ $attributes->merge(['class' => "grid {$colsClass} gap-4"]) }}>
    {{ $slot }}
</div>
