@props([
    'position' => 'top', // 'top' or 'bottom'
    'dismissible' => true,
])

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition
    tabindex="-1"
    {{ $attributes->merge(['class' => 'fixed ' . ($position === 'bottom' ? 'bottom-0' : 'top-0') . ' start-0 z-50 flex justify-between w-full p-4 border-b border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600']) }}
>
    <div class="flex items-center mx-auto">
        <div class="flex items-center text-sm font-normal text-gray-500 dark:text-gray-400">
            {{ $slot }}
        </div>
    </div>
    @if($dismissible)
        <div class="flex items-center">
            <button
                type="button"
                @click="show = false"
                class="shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white"
            >
                <x-prisma-icon name="x" size="xs" />
                <span class="sr-only">Cerrar banner</span>
            </button>
        </div>
    @endif
</div>
