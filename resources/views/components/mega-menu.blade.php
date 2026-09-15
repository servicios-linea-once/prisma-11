@props([
    'title' => 'Explorar',
])

<div x-data="{ open: false }" class="relative">
    <button
        @click="open = !open"
        type="button"
        class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded-sm md:w-auto hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"
    >
        <span>{{ $title }}</span>
        <x-prisma-icon name="chevron-down" size="xs" class="ms-1.5 transition-transform duration-200" ::class="open ? 'rotate-180' : ''" />
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        @click.outside="open = false"
        class="absolute z-30 grid w-auto max-w-screen-xl grid-cols-2 gap-4 p-4 mx-auto text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 md:grid-cols-3 dark:bg-gray-700 mt-2"
    >
        {{ $slot }}
    </div>
</div>
