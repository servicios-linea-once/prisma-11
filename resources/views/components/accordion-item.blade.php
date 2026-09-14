@props([
    'title',
    'id' => 'acc_' . uniqid(),
    'open' => false,
])

<div
    class="group"
    x-init="if (@js($open)) activeItems.push('{{ $id }}')"
    {{ $attributes }}
>
    <h3>
        <button
            type="button"
            class="w-full flex items-center justify-between px-5 py-4 text-start font-medium text-dark dark:text-light hover:bg-secondary/5 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-ring cursor-pointer"
            x-on:click="toggle('{{ $id }}')"
            :aria-expanded="isOpen('{{ $id }}').toString()"
            aria-controls="{{ $id }}-panel"
        >
            <span>{{ $title }}</span>
            <x-prisma-icon
                name="chevron-down"
                size="sm"
                class="text-secondary transition-transform duration-200"
                x-bind:class="isOpen('{{ $id }}') ? 'rotate-180' : ''"
            />
        </button>
    </h3>

    <div
        id="{{ $id }}-panel"
        x-show="isOpen('{{ $id }}')"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        class="px-5 pb-4 pt-1 text-sm text-secondary leading-relaxed border-t border-secondary/10"
        style="display: none;"
    >
        {{ $slot }}
    </div>
</div>
