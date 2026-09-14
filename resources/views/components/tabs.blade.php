@props([
    'active' => null,
    'variant' => 'line',
])

<div
    x-data="{
        active: @js($active),
        select(tab) {
            this.active = tab;
            this.$dispatch('prisma:tab-changed', { active: tab });
        }
    }"
    class="w-full space-y-4"
    {{ $attributes }}
>
    <!-- Tablist -->
    <div
        role="tablist"
        class="flex items-center gap-2 border-b border-secondary/20 overflow-x-auto select-none"
    >
        @if (isset($tabs))
            {{ $tabs }}
        @endif
    </div>

    <!-- Panels Content -->
    <div class="pt-2">
        {{ $slot }}
    </div>
</div>
