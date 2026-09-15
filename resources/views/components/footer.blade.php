@props([
    'brand' => config('app.name', 'Prisma 11'),
    'year' => date('Y'),
])

<footer {{ $attributes->merge(['class' => 'bg-white border-t border-gray-200 shadow-xs dark:bg-gray-800 dark:border-gray-700']) }}>
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
            © {{ $year }} <a href="/" class="hover:underline font-semibold">{{ $brand }}</a>. Todos los derechos reservados.
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0 space-x-4 rtl:space-x-reverse md:space-x-6">
            {{ $slot }}
        </ul>
    </div>
</footer>
