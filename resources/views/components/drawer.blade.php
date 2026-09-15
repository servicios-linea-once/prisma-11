@props([
    'position' => 'left', // left, right, top, bottom
    'title' => null,
    'id' => null,
])

@php
    $drawerId = $id ?? 'drawer_' . uniqid();
    
    $posClass = match($position) {
        'right' => 'top-0 right-0 h-screen w-80 translate-x-full',
        'top' => 'top-0 left-0 right-0 w-full h-80 -translate-y-full',
        'bottom' => 'bottom-0 left-0 right-0 w-full h-80 translate-y-full',
        default => 'top-0 left-0 h-screen w-80 -translate-x-full',
    };
@endphp

<div
    x-data="{ open: false }"
    @open-drawer-{{ $drawerId }}.window="open = true"
    @keydown.escape.window="open = false"
    class="relative z-50"
>
    <!-- Backdrop -->
    <div
        x-show="open"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false"
        class="fixed inset-0 bg-gray-900/50 dark:bg-gray-900/80"
        aria-hidden="true"
    ></div>

    <!-- Drawer Panel -->
    <div
        x-show="open"
        x-transition:enter="transform transition ease-in-out duration-300"
        x-transition:enter-start="{{ $posClass }}"
        x-transition:enter-end="translate-x-0 translate-y-0"
        x-transition:leave="transform transition ease-in-out duration-300"
        x-transition:leave-start="translate-x-0 translate-y-0"
        x-transition:leave-end="{{ $posClass }}"
        class="fixed z-50 p-4 overflow-y-auto bg-white dark:bg-gray-800 shadow-xl {{ match($position) {
            'right' => 'top-0 right-0 h-screen w-80',
            'top' => 'top-0 left-0 right-0 w-full h-80',
            'bottom' => 'bottom-0 left-0 right-0 w-full h-80',
            default => 'top-0 left-0 h-screen w-80',
        } }}"
        tabindex="-1"
    >
        <div class="flex items-center justify-between pb-3 border-b border-gray-200 dark:border-gray-700">
            @if($title)
                <h5 class="text-base font-semibold text-gray-500 dark:text-gray-400 uppercase">{{ $title }}</h5>
            @endif
            <button
                type="button"
                @click="open = false"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            >
                <x-prisma-icon name="x" size="sm" />
                <span class="sr-only">Cerrar</span>
            </button>
        </div>
        <div class="py-4">
            {{ $slot }}
        </div>
    </div>
</div>
