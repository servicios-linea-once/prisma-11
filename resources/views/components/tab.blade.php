@props([
    'name',
    'label' => null,
    'icon' => null,
    'badge' => null,
    'disabled' => false,
])

<button
    type="button"
    role="tab"
    :aria-selected="(active === '{{ $name }}').toString()"
    :tabindex="active === '{{ $name }}' ? '0' : '-1'"
    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium border-b-2 transition-all cursor-pointer select-none -mb-px focus:outline-none"
    :class="active === '{{ $name }}'
        ? 'border-primary text-primary font-semibold'
        : 'border-transparent text-secondary hover:text-dark dark:hover:text-light hover:border-secondary/40'"
    x-on:click="if (!@js($disabled)) select('{{ $name }}')"
    @disabled($disabled)
    {{ $attributes }}
>
    @if ($icon)
        <x-prisma-icon name="{{ $icon }}" size="sm" />
    @endif

    <span>{{ $label ?? $slot }}</span>

    @if ($badge)
        <span class="ms-1 px-1.5 py-0.5 text-[10px] rounded-full bg-secondary/15 text-secondary">
            {{ $badge }}
        </span>
    @endif
</button>
