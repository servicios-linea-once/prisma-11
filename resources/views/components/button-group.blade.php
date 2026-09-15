@props([
    'outline' => false,
])

<div {{ $attributes->merge(['class' => 'inline-flex rounded-md shadow-xs [&>button]:rounded-none [&>button:first-child]:rounded-s-lg [&>button:last-child]:rounded-e-lg [&>a]:rounded-none [&>a:first-child]:rounded-s-lg [&>a:last-child]:rounded-e-lg']) }} role="group">
    {{ $slot }}
</div>
