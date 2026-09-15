@props([
    'title' => null,
    'content' => null,
    'placement' => 'top', // top, bottom, left, right
])

<div x-data="{ open: false }" class="relative inline-block">
    <div @click="open = !open" @mouseenter="open = true" @mouseleave="open = false" class="inline-block cursor-pointer">
        {{ $trigger ?? $slot }}
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.outside="open = false"
        class="absolute z-50 w-64 text-sm text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800 {{ match($placement) {
            'bottom' => 'top-full mt-2 left-1/2 -translate-x-1/2',
            'left' => 'right-full mr-2 top-1/2 -translate-y-1/2',
            'right' => 'left-full ml-2 top-1/2 -translate-y-1/2',
            default => 'bottom-full mb-2 left-1/2 -translate-x-1/2',
        } }}"
        role="tooltip"
    >
        @if($title)
            <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $title }}</h3>
            </div>
        @endif
        <div class="px-3 py-2">
            {{ $content ?? '' }}
        </div>
    </div>
</div>
