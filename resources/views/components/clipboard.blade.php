@props([
    'value' => '',
])

<div
    x-data="{
        copied: false,
        copy() {
            navigator.clipboard.writeText('{{ addslashes($value) }}');
            this.copied = true;
            setTimeout(() => this.copied = false, 2000);
        }
    }"
    class="w-full max-w-[16rem]"
>
    <div class="relative">
        <label for="npm-install" class="sr-only">Label</label>
        <input
            type="text"
            readonly
            value="{{ $value }}"
            class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
        />
        <button
            type="button"
            @click="copy()"
            class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center cursor-pointer"
        >
            <span x-show="!copied" class="inline-flex items-center">
                <x-prisma-icon name="copy" size="xs" />
            </span>
            <span x-show="copied" class="inline-flex items-center text-blue-700 dark:text-blue-500">
                <x-prisma-icon name="check" size="xs" />
            </span>
        </button>
    </div>
</div>
