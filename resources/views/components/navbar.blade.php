@props([
    'brand' => config('app.name', 'Prisma 11'),
    'brandHref' => '/',
    'logo' => null,
])

<nav x-data="{ mobileOpen: false }" class="bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ $brandHref }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            @if($logo)
                <img src="{{ $logo }}" class="h-8" alt="{{ $brand }} Logo" />
            @endif
            <span class="self-center text-xl font-bold whitespace-nowrap text-gray-900 dark:text-white">{{ $brand }}</span>
        </a>

        <!-- Mobile hamburger button -->
        <button
            @click="mobileOpen = !mobileOpen"
            type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default"
            :aria-expanded="mobileOpen"
        >
            <span class="sr-only">Abrir menú principal</span>
            <x-prisma-icon name="menu" size="md" />
        </button>

        <!-- Navigation Links -->
        <div :class="{ 'block': mobileOpen, 'hidden': !mobileOpen }" class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                {{ $slot }}
            </ul>
        </div>
    </div>
</nav>
