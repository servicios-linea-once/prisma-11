@props([
    'position' => 'bottom-right',
    'direction' => 'top',
])

<div x-data="{ open: false }" class="fixed end-6 bottom-6 group z-40">
    <div
        x-show="open"
        x-transition
        class="flex flex-col items-center mb-4 space-y-2"
    >
        {{ $slot }}
    </div>
    <button
        type="button"
        @click="open = !open"
        class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800 shadow-lg cursor-pointer"
        aria-expanded="false"
    >
        <x-prisma-icon name="plus" size="md" class="transition-transform duration-200" ::class="open ? 'rotate-45' : ''" />
        <span class="sr-only">Menú rápido</span>
    </button>
</div>
