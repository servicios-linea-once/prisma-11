@props([
    'id' => 'slide_over_' . uniqid(),
    'title' => null,
    'placement' => 'end',
    'size' => 'md',
    'backdrop' => true,
    'closeable' => true,
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'max-w-xs',
        'lg' => 'max-w-xl',
        'xl' => 'max-w-2xl',
        'full' => 'max-w-full',
        default => 'max-w-md', // md
    };

    $positionClasses = $placement === 'start' ? 'left-0' : 'right-0';
    $enterStartClass = $placement === 'start' ? '-translate-x-full' : 'translate-x-full';
@endphp

<div
    x-data="{
        open: false,
        releaseTrap: null,
        show() {
            this.open = true;
            document.body.classList.add('overflow-hidden');
            this.$nextTick(() => {
                if (window.PrismaFocusTrap) {
                    this.releaseTrap = window.PrismaFocusTrap.trap(this.$refs.panel, this.$refs.trigger);
                }
            });
        },
        hide() {
            this.open = false;
            document.body.classList.remove('overflow-hidden');
            if (this.releaseTrap) {
                this.releaseTrap();
                this.releaseTrap = null;
            }
        }
    }"
    x-on:prisma:slide-over-open.window="if ($event.detail.id === '{{ $id }}') show()"
    x-on:prisma:slide-over-close.window="if ($event.detail.id === '{{ $id }}') hide()"
    x-on:keydown.escape.window="if (open && @js($closeable)) hide()"
    {{ $attributes }}
>
    @if (isset($trigger))
        <div x-ref="trigger" x-on:click="show()">
            {{ $trigger }}
        </div>
    @endif

    <template x-teleport="body">
        <div
            x-show="open"
            class="fixed inset-0 z-50 overflow-hidden"
            style="display: none;"
            role="dialog"
            aria-modal="true"
            aria-labelledby="{{ $id }}-title"
        >
            <!-- Backdrop -->
            @if ($backdrop)
                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-dark/60 backdrop-blur-xs transition-opacity"
                    @if ($closeable) x-on:click="hide()" @endif
                    aria-hidden="true"
                ></div>
            @endif

            <div class="fixed inset-y-0 {{ $positionClasses }} flex max-w-full">
                <!-- Panel Drawer -->
                <div
                    x-ref="panel"
                    x-show="open"
                    x-transition:enter="transform transition ease-in-out duration-300 sm:duration-500"
                    x-transition:enter-start="{{ $enterStartClass }}"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-300 sm:duration-500"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="{{ $enterStartClass }}"
                    class="w-screen {{ $sizeClasses }} bg-light dark:bg-dark text-dark dark:text-light shadow-2xl border-s border-secondary/20 flex flex-col justify-between overflow-y-auto"
                >
                    <!-- Header -->
                    @if ($title || isset($header) || $closeable)
                        <div class="flex items-center justify-between px-6 py-4 border-b border-secondary/15">
                            <div class="flex-1">
                                @if (isset($header))
                                    {{ $header }}
                                @elseif ($title)
                                    <h3 id="{{ $id }}-title" class="text-lg font-semibold">
                                        {{ $title }}
                                    </h3>
                                @endif
                            </div>

                            @if ($closeable)
                                <button
                                    type="button"
                                    class="p-1 rounded-md text-secondary hover:text-dark dark:hover:text-light hover:bg-secondary/10 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-ring cursor-pointer"
                                    x-on:click="hide()"
                                    aria-label="{{ __('prisma::messages.modal.close_aria') }}"
                                >
                                    <x-prisma-icon name="x" size="sm" />
                                </button>
                            @endif
                        </div>
                    @endif

                    <!-- Body -->
                    <div class="px-6 py-5 flex-1 overflow-y-auto">
                        {{ $slot }}
                    </div>

                    <!-- Footer -->
                    @if (isset($footer))
                        <div class="flex items-center justify-end gap-3 px-6 py-4 bg-secondary/5 dark:bg-secondary/10 border-t border-secondary/15">
                            {{ $footer }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>
