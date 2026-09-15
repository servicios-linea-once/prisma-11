<div {{ $attributes->merge(['class' => 'fixed bottom-0 start-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600']) }}>
    <div class="grid h-full max-w-lg grid-flow-col auto-cols-fr mx-auto font-medium">
        {{ $slot }}
    </div>
</div>
