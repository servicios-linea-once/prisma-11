@props([
    'position' => 'top-end',
    'duration' => 4000,
])

<div
    x-data="{
        toasts: [],
        add(detail) {
            const id = Date.now() + Math.random();
            const toast = {
                id: id,
                title: detail.title || '',
                message: detail.message || '',
                type: detail.type || 'info',
                duration: detail.duration || {{ $duration }},
                timeout: null
            };

            this.toasts.push(toast);

            toast.timeout = setTimeout(() => {
                this.remove(id);
            }, toast.duration);
        },
        remove(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index !== -1) {
                clearTimeout(this.toasts[index].timeout);
                this.toasts.splice(index, 1);
            }
        },
        pause(toast) {
            clearTimeout(toast.timeout);
        },
        resume(toast) {
            toast.timeout = setTimeout(() => {
                this.remove(toast.id);
            }, 1500);
        }
    }"
    x-on:prisma:toast.window="add($event.detail)"
    role="status"
    aria-live="polite"
    class="fixed z-50 pointer-events-none flex flex-col gap-2.5 max-w-sm w-full {{ $positionClasses() }}"
    {{ $attributes }}
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            x-on:mouseenter="pause(toast)"
            x-on:mouseleave="resume(toast)"
            class="pointer-events-auto w-full p-4 rounded-lg shadow-xl border bg-light dark:bg-dark text-dark dark:text-light flex items-start gap-3 transition-all"
            :class="{
                'border-success/30': toast.type === 'success',
                'border-danger/30': toast.type === 'danger',
                'border-warning/30': toast.type === 'warning',
                'border-info/30': toast.type === 'info',
                'border-secondary/20': !['success', 'danger', 'warning', 'info'].includes(toast.type)
            }"
        >
            <!-- Semantic Icon -->
            <div class="shrink-0 mt-0.5">
                <template x-if="toast.type === 'success'">
                    <span class="text-success"><x-prisma-icon name="check-circle" size="md" /></span>
                </template>
                <template x-if="toast.type === 'danger'">
                    <span class="text-danger"><x-prisma-icon name="alert-circle" size="md" /></span>
                </template>
                <template x-if="toast.type === 'warning'">
                    <span class="text-warning"><x-prisma-icon name="alert-triangle" size="md" /></span>
                </template>
                <template x-if="!['success', 'danger', 'warning'].includes(toast.type)">
                    <span class="text-info"><x-prisma-icon name="info" size="md" /></span>
                </template>
            </div>

            <!-- Content -->
            <div class="flex-1 text-sm">
                <template x-if="toast.title">
                    <h5 class="font-semibold text-sm mb-0.5" x-text="toast.title"></h5>
                </template>
                <p class="text-xs text-secondary leading-normal" x-text="toast.message"></p>
            </div>

            <!-- Dismiss -->
            <button
                type="button"
                class="shrink-0 p-1 -m-1 rounded text-secondary hover:text-dark dark:hover:text-light transition-colors focus:outline-none"
                x-on:click="remove(toast.id)"
                aria-label="{{ __('prisma::messages.toast.close_aria') }}"
            >
                <x-prisma-icon name="x" size="xs" />
            </button>
        </div>
    </template>
</div>
