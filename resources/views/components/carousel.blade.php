@props([
    'slides' => 3,
    'autoplay' => false,
])

<div
    x-data="{
        active: 0,
        total: {{ (int) $slides }},
        next() { this.active = (this.active + 1) % this.total },
        prev() { this.active = (this.active - 1 + this.total) % this.total }
    }"
    class="relative w-full"
>
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96 bg-gray-100 dark:bg-gray-800">
        {{ $slot }}
    </div>

    <!-- Slider controls -->
    <button
        type="button"
        @click="prev()"
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
    >
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <x-prisma-icon name="chevron-left" size="sm" class="text-white rtl:rotate-180" />
            <span class="sr-only">Anterior</span>
        </span>
    </button>
    <button
        type="button"
        @click="next()"
        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
    >
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <x-prisma-icon name="chevron-right" size="sm" class="text-white rtl:rotate-180" />
            <span class="sr-only">Siguiente</span>
        </span>
    </button>
</div>
