@props([
    'label' => null,
    'helper' => null,
    'dropzone' => false,
    'id' => null,
])

@php
    $inputId = $id ?? 'file_input_' . uniqid();
@endphp

<div class="w-full">
    @if($label && !$dropzone)
        <label for="{{ $inputId }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}
        </label>
    @endif

    @if($dropzone)
        <label for="{{ $inputId }}" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <x-prisma-icon name="cloud-upload" size="lg" class="mb-3 text-gray-400 dark:text-gray-400" />
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">{{ $label ?? 'Haz clic para subir' }}</span> o arrastra y suelta</p>
                @if($helper)
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $helper }}</p>
                @endif
            </div>
            <input id="{{ $inputId }}" type="file" {{ $attributes->merge(['class' => 'hidden']) }} />
        </label>
    @else
        <input id="{{ $inputId }}" type="file" {{ $attributes->merge(['class' => 'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400']) }} />
        @if($helper)
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $helper }}</p>
        @endif
    @endif
</div>
