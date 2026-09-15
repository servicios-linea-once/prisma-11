@props([
    'href' => '#',
    'external' => false,
])

<a
    href="{{ $href }}"
    @if($external) target="_blank" rel="noopener noreferrer" @endif
    {{ $attributes->merge(['class' => 'font-medium text-blue-600 dark:text-blue-500 hover:underline inline-flex items-center gap-1']) }}
>
    {{ $slot }}
    @if($external)
        <x-prisma-icon name="external-link" size="xs" />
    @endif
</a>
