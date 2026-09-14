@props([
    'title' => null,
    'description' => null,
    'icon' => 'search',
    'action' => null,
    'actionUrl' => null,
])

@php
    $displayTitle = $title ?? __('prisma::messages.empty_state.title');
    $displayDescription = $description ?? __('prisma::messages.empty_state.description');

    $containerClasses = \ServicioLineaOnce\Prisma11\Support\TailwindClassMerge::merge(
        'text-center py-12 px-6 flex flex-col items-center justify-center',
        $attributes->get('class')
    );
@endphp

<div {{ $attributes->except('class')->merge(['class' => $containerClasses]) }}>
    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-p11-muted/10 text-p11-muted mb-4 ring-8 ring-p11-muted/5">
        @if (isset($iconSlot))
            {{ $iconSlot }}
        @else
            <x-prisma-icon :name="$icon" class="h-6 w-6" />
        @endif
    </div>

    <h3 class="text-base font-semibold text-p11-surface-content">
        {{ $displayTitle }}
    </h3>

    @if ($displayDescription)
        <p class="mt-1 text-sm text-p11-muted max-w-sm">
            {{ $displayDescription }}
        </p>
    @endif

    {{ $slot }}

    @if (isset($actions))
        <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
            {{ $actions }}
        </div>
    @elseif ($action)
        <div class="mt-6">
            <x-prisma-button :href="$actionUrl" variant="primary" size="sm">
                {{ $action }}
            </x-prisma-button>
        </div>
    @endif
</div>
