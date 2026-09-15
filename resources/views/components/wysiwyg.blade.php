@props([
    'placeholder' => 'Escribe aquí tu contenido...',
    'id' => null,
])

@php
    $editorId = $id ?? 'wysiwyg_' . uniqid();
@endphp

<div class="w-full border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
    <!-- Toolbar -->
    <div class="flex items-center justify-between px-3 py-2 border-b border-gray-200 dark:border-gray-600">
        <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x sm:rtl:divide-x-reverse dark:divide-gray-600">
            <div class="flex items-center space-x-1 rtl:space-x-reverse sm:pe-4">
                <button type="button" class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <x-prisma-icon name="bold" size="xs" />
                </button>
                <button type="button" class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <x-prisma-icon name="italic" size="xs" />
                </button>
                <button type="button" class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <x-prisma-icon name="link" size="xs" />
                </button>
                <button type="button" class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <x-prisma-icon name="image" size="xs" />
                </button>
                <button type="button" class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <x-prisma-icon name="code" size="xs" />
                </button>
            </div>
        </div>
    </div>
    <!-- Editor body -->
    <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800">
        <textarea
            id="{{ $editorId }}"
            rows="6"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400 focus:outline-none']) }}
        >{{ $slot }}</textarea>
    </div>
</div>
