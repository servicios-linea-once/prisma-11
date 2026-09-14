@props([
    'placement' => 'bottom-start',
    'width' => 'w-48',
])

<div
    x-data="{
        open: false,
        toggle() {
            this.open = !this.open;
            if (this.open) {
                this.$nextTick(() => {
                    if (window.PrismaFloating) {
                        window.PrismaFloating.computePosition(this.$refs.trigger, this.$refs.menu, { placement: '{{ $placement }}' });
                    }
                    if (window.PrismaRovingTabindex) {
                        window.PrismaRovingTabindex.attach(this.$refs.menu);
                    }
                });
            }
        },
        close() {
            this.open = false;
        }
    }"
    x-on:keydown.escape.window="close()"
    x-on:click.outside="close()"
    class="relative inline-block text-start"
    {{ $attributes }}
>
    <!-- Trigger -->
    <div x-ref="trigger" x-on:click="toggle()" class="inline-flex cursor-pointer select-none">
        {{ $trigger }}
    </div>

    <!-- Floating Menu -->
    <div
        x-ref="menu"
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        role="menu"
        aria-orientation="vertical"
        tabindex="-1"
        style="display: none;"
        class="{{ $width }} bg-light dark:bg-dark text-dark dark:text-light rounded-md shadow-lg border border-secondary/20 py-1 focus:outline-none z-50 text-sm divide-y divide-secondary/10"
        x-on:click="close()"
    >
        {{ $slot }}
    </div>
</div>
