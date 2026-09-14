@props([
    'title' => null,
    'description' => null,
    'padding' => 'md',
    'bordered' => true,
    'shadow' => 'sm',
    'hover' => false,
])

@php
    $paddingClasses = match ($padding) {
        'none' => 'p-0',
        'sm' => 'p-3 sm:p-4',
        'lg' => 'p-6 sm:p-8',
        default => 'p-4 sm:p-6',
    };

    $shadowClasses = match ($shadow) {
        'none' => '',
        'md' => 'shadow-md',
        'lg' => 'shadow-lg',
        default => 'shadow-sm',
    };

    $containerClasses = \ServicioLineaOnce\Prisma11\Support\TailwindClassMerge::merge(
        'bg-p11-surface text-p11-surface-content rounded-xl overflow-hidden transition-all duration-200',
        $bordered ? 'border border-p11-surface-stroke' : '',
        $shadowClasses,
        $hover ? 'hover:shadow-md hover:-translate-y-0.5' : '',
        $attributes->get('class')
    );
@endphp

<div {{ $attributes->except('class')->merge(['class' => $containerClasses]) }}>
    @if (isset($header) || $title || $description || isset($actions))
        <div class="px-5 py-4 sm:px-6 border-b border-p11-surface-stroke flex items-center justify-between gap-4">
            @if (isset($header))
                {{ $header }}
            @else
                <div class="min-w-0 flex-1">
                    @if ($title)
                        <h3 class="text-base font-semibold text-p11-surface-content leading-6 truncate">
                            {{ $title }}
                        </h3>
                    @endif
                    @if ($description)
                        <p class="mt-0.5 text-xs sm:text-sm text-p11-muted">
                            {{ $description }}
                        </p>
                    @endif
                </div>
                @if (isset($actions))
                    <div class="flex items-center gap-2 shrink-0">
                        {{ $actions }}
                    </div>
                @endif
            @endif
        </div>
    @endif

    <div class="{{ $paddingClasses }}">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="px-5 py-3.5 sm:px-6 border-t border-p11-surface-stroke bg-p11-muted/5 flex items-center justify-between">
            {{ $footer }}
        </div>
    @endif
</div>
