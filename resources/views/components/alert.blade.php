@props([
    'classes' => '',
    'color' => 'info',
    'title' => null,
    'icon' => null,
    'dismissible' => false,
])

<div
    @if ($dismissible) x-data="{ show: true }" x-show="show" x-transition.duration.200ms @endif
    role="alert"
    {{ $attributes->except('class')->merge(['class' => $classes]) }}
>
    @if ($icon)
        <div class="shrink-0 text-{{ $color }} mt-0.5">
            <x-prisma-icon name="{{ $icon }}" size="md" />
        </div>
    @endif

    <div class="flex-1 text-sm">
        @if ($title)
            <h4 class="font-semibold mb-1 text-{{ $color }} dark:text-{{ $color }}">
                {{ $title }}
            </h4>
        @endif

        <div class="leading-relaxed opacity-90">
            {{ $slot }}
        </div>
    </div>

    @if ($dismissible)
        <button
            type="button"
            class="shrink-0 p-1 -m-1 rounded-md text-secondary hover:text-dark dark:hover:text-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary-ring cursor-pointer"
            x-on:click="show = false"
            aria-label="{{ __('prisma::messages.dismiss') }}"
        >
            <x-prisma-icon name="x" size="xs" />
        </button>
    @endif
</div>
