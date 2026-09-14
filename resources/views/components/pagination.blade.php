@props([
    'currentPage' => 1,
    'totalPages' => 1,
    'totalItems' => null,
    'perPage' => 10,
])

@php
    $startItem = ($currentPage - 1) * $perPage + 1;
    $endItem = $totalItems !== null ? min($currentPage * $perPage, $totalItems) : $currentPage * $perPage;
@endphp

<nav
    role="navigation"
    aria-label="{{ __('prisma::messages.pagination.results') }}"
    class="flex items-center justify-between flex-wrap gap-4 py-3"
    {{ $attributes }}
>
    <!-- Counter description -->
    @if ($totalItems !== null)
        <div class="text-sm text-secondary">
            <span>{{ __('prisma::messages.pagination.showing') }}</span>
            <span class="font-semibold text-dark dark:text-light">{{ $startItem }}</span>
            <span>{{ __('prisma::messages.pagination.to') }}</span>
            <span class="font-semibold text-dark dark:text-light">{{ $endItem }}</span>
            <span>{{ __('prisma::messages.pagination.of') }}</span>
            <span class="font-semibold text-dark dark:text-light">{{ $totalItems }}</span>
            <span>{{ __('prisma::messages.pagination.results') }}</span>
        </div>
    @endif

    <!-- Controls -->
    <div class="flex items-center gap-1.5 ms-auto">
        <!-- Previous -->
        <button
            type="button"
            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium rounded-md border border-secondary/30 bg-light dark:bg-dark text-dark dark:text-light hover:bg-secondary/10 transition-colors disabled:opacity-40 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-primary-ring cursor-pointer"
            @disabled($currentPage <= 1)
        >
            <x-prisma-icon name="chevron-left" size="xs" />
            <span>{{ __('prisma::messages.pagination.previous') }}</span>
        </button>

        <!-- Current Page Indicator -->
        <span class="px-3 py-1.5 text-sm font-medium text-secondary">
            {{ $currentPage }} / {{ $totalPages }}
        </span>

        <!-- Next -->
        <button
            type="button"
            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium rounded-md border border-secondary/30 bg-light dark:bg-dark text-dark dark:text-light hover:bg-secondary/10 transition-colors disabled:opacity-40 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-primary-ring cursor-pointer"
            @disabled($currentPage >= $totalPages)
        >
            <span>{{ __('prisma::messages.pagination.next') }}</span>
            <x-prisma-icon name="chevron-right" size="xs" />
        </button>
    </div>
</nav>
