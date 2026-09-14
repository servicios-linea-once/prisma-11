@props([
    'multiple' => false,
])

<div
    x-data="{
        multiple: @js($multiple),
        activeItems: [],
        toggle(id) {
            if (this.multiple) {
                if (this.activeItems.includes(id)) {
                    this.activeItems = this.activeItems.filter(i => i !== id);
                } else {
                    this.activeItems.push(id);
                }
            } else {
                this.activeItems = this.activeItems.includes(id) ? [] : [id];
            }
        },
        isOpen(id) {
            return this.activeItems.includes(id);
        }
    }"
    class="w-full divide-y divide-secondary/15 rounded-lg border border-secondary/20 overflow-hidden bg-light dark:bg-dark text-dark dark:text-light"
    {{ $attributes }}
>
    {{ $slot }}
</div>
