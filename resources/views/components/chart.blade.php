@props([
    'title' => null,
    'subtitle' => null,
])

<div {{ $attributes->merge(['class' => 'max-w-sm w-full bg-white rounded-lg shadow-xs dark:bg-gray-800 p-4 md:p-6 border border-gray-200 dark:border-gray-700']) }}>
    @if($title || $subtitle)
        <div class="flex justify-between mb-4">
            <div>
                @if($title)
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ $title }}</h5>
                @endif
                @if($subtitle)
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $subtitle }}</p>
                @endif
            </div>
        </div>
    @endif
    <div class="py-6">
        {{ $slot }}
    </div>
</div>
