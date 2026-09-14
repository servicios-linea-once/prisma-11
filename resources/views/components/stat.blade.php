@props([
    'label',
    'value',
    'description' => null,
    'change' => null,
    'trend' => null,
    'icon' => null,
    'color' => 'primary',
])

@php
    $inferredTrend = $trend;
    if ($inferredTrend === null && $change !== null) {
        if (str_starts_with((string) $change, '+')) {
            $inferredTrend = 'up';
        } elseif (str_starts_with((string) $change, '-')) {
            $inferredTrend = 'down';
        } else {
            $inferredTrend = 'neutral';
        }
    }

    $trendColor = match ($inferredTrend) {
        'up' => 'text-p11-success bg-p11-success/10',
        'down' => 'text-p11-danger bg-p11-danger/10',
        'neutral' => 'text-p11-muted bg-p11-muted/10',
        default => '',
    };

    $iconColor = match ($color) {
        'success' => 'bg-p11-success/10 text-p11-success',
        'warning' => 'bg-p11-warning/10 text-p11-warning',
        'danger' => 'bg-p11-danger/10 text-p11-danger',
        'info' => 'bg-p11-info/10 text-p11-info',
        'secondary' => 'bg-p11-secondary/10 text-p11-secondary',
        default => 'bg-p11-primary/10 text-p11-primary',
    };

    $containerClasses = \ServicioLineaOnce\Prisma11\Support\TailwindClassMerge::merge(
        'bg-p11-surface border border-p11-surface-stroke rounded-xl p-5 sm:p-6 shadow-sm transition-all duration-200',
        $attributes->get('class')
    );
@endphp

<div {{ $attributes->except('class')->merge(['class' => $containerClasses]) }}>
    <div class="flex items-center justify-between gap-4">
        <dt class="text-xs sm:text-sm font-medium text-p11-muted truncate">
            {{ $label }}
        </dt>
        @if (isset($iconSlot) || $icon)
            <div class="flex items-center justify-center w-10 h-10 rounded-lg {{ $iconColor }} shrink-0">
                @if (isset($iconSlot))
                    {{ $iconSlot }}
                @else
                    <x-prisma-icon :name="$icon" class="w-5 h-5" />
                @endif
            </div>
        @endif
    </div>

    <dd class="mt-2 flex items-baseline justify-between gap-2">
        <div class="text-2xl sm:text-3xl font-bold tracking-tight text-p11-surface-content">
            {{ $value }}
        </div>

        @if ($change !== null)
            <div class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold {{ $trendColor }}">
                @if ($inferredTrend === 'up')
                    <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                    </svg>
                @elseif ($inferredTrend === 'down')
                    <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                    </svg>
                @endif
                <span>{{ $change }}</span>
            </div>
        @endif
    </dd>

    @if ($description)
        <p class="mt-1 text-xs text-p11-muted">
            {{ $description }}
        </p>
    @endif
</div>
