@props([
    'ariaLabel' => 'Sidebar',
])

<aside {{ $attributes->merge(['class' => 'w-64 h-full min-h-screen transition-transform border-e border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800']) }} aria-label="{{ $ariaLabel }}">
    <div class="h-full px-3 py-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            {{ $slot }}
        </ul>
    </div>
</aside>
