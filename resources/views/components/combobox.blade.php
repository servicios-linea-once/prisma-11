@props([
    'name' => null,
    'id' => null,
    'label' => null,
    'options' => [],
    'placeholder' => null,
    'value' => '',
    'hint' => null,
    'required' => false,
    'disabled' => false,
])

@php
    $resolvedId = $id ?? ($name ? 'combobox_' . $name : 'combobox_' . uniqid());
    $placeholderText = $placeholder ?? __('prisma::messages.select_option');
@endphp

<div
    class="w-full space-y-1.5"
    x-data="{
        open: false,
        selected: @js($value),
        search: '',
        options: {!! json_encode($options, JSON_UNESCAPED_UNICODE) !!},
        get selectedLabel() {
            if (this.selected && this.options[this.selected]) {
                return this.options[this.selected];
            }
            return '';
        },
        filteredOptions() {
            if (!this.search) return this.options;
            const s = this.search.toLowerCase();
            const filtered = {};
            for (const [k, v] of Object.entries(this.options)) {
                if (v.toLowerCase().includes(s)) {
                    filtered[k] = v;
                }
            }
            return filtered;
        },
        select(key) {
            this.selected = key;
            this.search = '';
            this.open = false;
            if (this.$refs.input) {
                this.$refs.input.value = key;
                this.$refs.input.dispatchEvent(new Event('input'));
                this.$refs.input.dispatchEvent(new Event('change'));
            }
        }
    }"
    x-on:click.outside="open = false"
    x-on:keydown.escape.window="open = false"
    {{ $attributes->except(['class', 'name', 'id', 'options', 'placeholder', 'value']) }}
>
    @if ($label)
        <label for="{{ $resolvedId }}" class="block text-sm font-medium text-dark dark:text-light select-none">
            {{ $label }}
            @if ($required)
                <span class="text-danger ms-0.5" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <button
            type="button"
            id="{{ $resolvedId }}"
            role="combobox"
            aria-haspopup="listbox"
            :aria-expanded="open.toString()"
            class="w-full flex items-center justify-between rounded-md px-3.5 py-2.5 text-sm border border-secondary/30 bg-light dark:bg-dark text-dark dark:text-light text-start transition-all duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-ring"
            x-on:click="open = !open; if (open) $nextTick(() => $refs.searchInput?.focus())"
            @disabled($disabled)
        >
            <span x-text="selectedLabel || '{{ $placeholderText }}'" :class="!selectedLabel ? 'text-secondary' : ''"></span>
            <x-prisma-icon name="chevron-down" size="xs" class="text-secondary transition-transform duration-150" x-bind:class="open ? 'rotate-180' : ''" />
        </button>

        <input
            type="hidden"
            x-ref="input"
            @if ($name) name="{{ $name }}" @endif
            :value="selected"
        />

        <!-- Popover Options -->
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute start-0 end-0 mt-1.5 bg-light dark:bg-dark text-dark dark:text-light rounded-md shadow-xl border border-secondary/20 py-1 z-50 max-h-60 overflow-y-auto focus:outline-none"
            role="listbox"
            style="display: none;"
        >
            <div class="px-2 py-1.5 border-b border-secondary/15">
                <input
                    type="text"
                    x-ref="searchInput"
                    x-model="search"
                    placeholder="{{ __('prisma::messages.search') }}"
                    class="w-full px-2.5 py-1 text-xs rounded border border-secondary/30 bg-transparent text-dark dark:text-light placeholder-secondary focus:outline-none focus:ring-1 focus:ring-primary"
                    x-on:keydown.stop
                />
            </div>

            <template x-for="(label, key) in filteredOptions()" :key="key">
                <div
                    role="option"
                    :aria-selected="(selected === key).toString()"
                    class="flex items-center justify-between px-3.5 py-2 text-sm cursor-pointer select-none hover:bg-primary/10 hover:text-primary transition-colors"
                    :class="selected === key ? 'font-semibold text-primary bg-primary/5' : ''"
                    x-on:click="select(key)"
                >
                    <span x-text="label"></span>
                    <x-prisma-icon name="check" size="xs" x-show="selected === key" />
                </div>
            </template>

            <div
                x-show="Object.keys(filteredOptions()).length === 0"
                class="px-3.5 py-3 text-xs text-center text-secondary"
            >
                {{ __('prisma::messages.no_results') }}
            </div>
        </div>
    </div>

    @if ($hint)
        <p class="text-xs text-secondary mt-1">
            {{ $hint }}
        </p>
    @endif
</div>
