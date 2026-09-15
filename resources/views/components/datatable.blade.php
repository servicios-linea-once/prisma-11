@props([
    'headers' => [],
    'rows' => [],
    'perPage' => 5,
    'searchable' => true,
])

<div
    x-data="{
        search: '',
        currentPage: 1,
        perPage: {{ (int) $perPage }},
        sortCol: null,
        sortAsc: true,
        rawData: {{ json_encode($rows) }},
        get filteredRows() {
            let data = this.rawData;
            if (this.search) {
                const s = this.search.toLowerCase();
                data = data.filter(row => Object.values(row).some(val => String(val).toLowerCase().includes(s)));
            }
            if (this.sortCol !== null) {
                data = [...data].sort((a, b) => {
                    const valA = a[this.sortCol] ?? '';
                    const valB = b[this.sortCol] ?? '';
                    return this.sortAsc ? (valA > valB ? 1 : -1) : (valA < valB ? 1 : -1);
                });
            }
            return data;
        },
        get paginatedRows() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredRows.slice(start, start + this.perPage);
        },
        get totalPages() {
            return Math.max(1, Math.ceil(this.filteredRows.length / this.perPage));
        },
        sortBy(key) {
            if (this.sortCol === key) {
                this.sortAsc = !this.sortAsc;
            } else {
                this.sortCol = key;
                this.sortAsc = true;
            }
        }
    }"
    class="relative overflow-x-auto shadow-xs sm:rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800"
>
    @if($searchable)
        <div class="p-4 flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-gray-500">
                    <x-prisma-icon name="search" size="xs" />
                </div>
                <input
                    type="text"
                    x-model="search"
                    @input="currentPage = 1"
                    placeholder="Filtrar registros..."
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                />
            </div>
        </div>
    @endif

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach($headers as $key => $label)
                    <th scope="col" class="px-6 py-3 cursor-pointer select-none hover:bg-gray-100 dark:hover:bg-gray-600" @click="sortBy('{{ $key }}')">
                        <div class="flex items-center gap-1">
                            <span>{{ $label }}</span>
                            <x-prisma-icon name="arrow-up-down" size="xs" class="text-gray-400" />
                        </div>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <template x-for="(row, idx) in paginatedRows" :key="idx">
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    @foreach($headers as $key => $label)
                        <td class="px-6 py-4" x-text="row['{{ $key }}'] ?? ''"></td>
                    @endforeach
                </tr>
            </template>
            <tr x-show="paginatedRows.length === 0">
                <td colspan="{{ count($headers) }}" class="px-6 py-8 text-center text-gray-500">
                    No se encontraron registros coincidentes.
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Pagination Footer -->
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between p-4 border-t border-gray-200 dark:border-gray-700" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
            Página <span class="font-semibold text-gray-900 dark:text-white" x-text="currentPage"></span> de <span class="font-semibold text-gray-900 dark:text-white" x-text="totalPages"></span>
        </span>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            <li>
                <button
                    type="button"
                    @click="currentPage = Math.max(1, currentPage - 1)"
                    :disabled="currentPage === 1"
                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white disabled:opacity-50 cursor-pointer"
                >
                    Anterior
                </button>
            </li>
            <li>
                <button
                    type="button"
                    @click="currentPage = Math.min(totalPages, currentPage + 1)"
                    :disabled="currentPage === totalPages"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white disabled:opacity-50 cursor-pointer"
                >
                    Siguiente
                </button>
            </li>
        </ul>
    </nav>
</div>
