@props([
    'themes' => null,
])

@php
    $themeList = $themes ?? config('prisma.themes', [
        'default' => 'Default',
        'retro' => 'Retro',
        'cyberpunk' => 'Cyberpunk',
        'valentine' => 'Valentine',
        'aqua' => 'Aqua',
    ]);
@endphp

<div
    x-data="{
        open: false,
        activeTheme: $store.prisma ? $store.prisma.theme : 'default',
        get themeName() {
            const map = {{ json_encode($themeList) }};
            return map[this.activeTheme] || 'Default';
        },
        select(key) {
            this.activeTheme = key;
            if ($store.prisma) {
                $store.prisma.setTheme(key);
            } else {
                document.documentElement.setAttribute('data-theme', key);
            }
            this.open = false;
        }
    }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
    class="relative inline-block text-left select-none w-36"
    {{ $attributes }}
>
    <!-- Botón / Cabecera Activa (Fiel a la Imagen de Referencia) -->
    <button
        type="button"
        @click="open = !open"
        class="w-full px-4 py-2 text-sm font-semibold text-white bg-[#3f8306] hover:bg-[#357005] transition-colors duration-150 flex items-center justify-between shadow-xs"
        :class="open ? 'rounded-t-xl' : 'rounded-xl'"
        aria-haspopup="true"
        :aria-expanded="open.toString()"
    >
        <span class="w-full text-center font-bold tracking-wide" x-text="themeName">Default</span>
        <svg class="w-3.5 h-3.5 ms-1 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open }" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>

    <!-- Menú Desplegable con los temas oficiales -->
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute left-0 right-0 z-50 overflow-hidden bg-[#e2e7dd] dark:bg-gray-800 rounded-b-xl shadow-lg border border-t-0 border-gray-300 dark:border-gray-700"
    >
        <ul class="py-1 text-sm font-medium text-gray-900 dark:text-gray-100 divide-y divide-gray-200/50 dark:divide-gray-700/50">
            @foreach($themeList as $key => $name)
                <li x-show="activeTheme !== '{{ $key }}'">
                    <button
                        type="button"
                        @click="select('{{ $key }}')"
                        class="w-full text-center py-2 px-3 hover:bg-[#d4dccf] dark:hover:bg-gray-700 transition-colors duration-150 text-gray-800 dark:text-gray-200 font-semibold cursor-pointer"
                    >
                        {{ $name }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
</div>
