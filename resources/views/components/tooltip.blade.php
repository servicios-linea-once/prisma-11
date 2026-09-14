@props([
    'text',
    'placement' => 'top',
])

<div
    x-data="{
        show: false,
        display() {
            this.show = true;
            this.$nextTick(() => {
                if (window.PrismaFloating) {
                    window.PrismaFloating.computePosition(this.$refs.anchor, this.$refs.bubble, {
                        placement: '{{ $placement }}',
                        offset: 6,
                        zIndex: '60'
                    });
                }
            });
        },
        hide() {
            this.show = false;
        }
    }"
    class="relative inline-flex"
    x-on:mouseenter="display()"
    x-on:mouseleave="hide()"
    x-on:focusin="display()"
    x-on:focusout="hide()"
    {{ $attributes }}
>
    <div x-ref="anchor" class="inline-flex">
        {{ $slot }}
    </div>

    <div
        x-ref="bubble"
        x-show="show"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        role="tooltip"
        style="display: none;"
        class="pointer-events-none px-2.5 py-1 text-xs font-medium rounded shadow-md bg-dark text-light dark:bg-light dark:text-dark border border-secondary/20 whitespace-nowrap z-50"
    >
        {{ $text }}
    </div>
</div>
