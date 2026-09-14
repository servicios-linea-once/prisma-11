@props([
    'variant' => 'text',
    'type' => null,
    'lines' => 1,
    'width' => null,
    'height' => null,
    'animate' => true,
])

@php
    $resolvedVariant = $type ?? $variant;

    $baseClasses = 'bg-p11-muted/20 dark:bg-p11-muted/30';
    $animationClass = $animate ? 'animate-pulse' : '';

    $shapeClasses = match ($resolvedVariant) {
        'circular', 'circle', 'avatar' => 'rounded-full shrink-0 ' . ($width ?? 'w-10') . ' ' . ($height ?? 'h-10'),
        'rectangular', 'rect', 'card' => 'rounded-xl ' . ($width ?? 'w-full') . ' ' . ($height ?? 'h-32'),
        default => 'rounded-md ' . ($height ?? 'h-4'),
    };
@endphp

@if ($resolvedVariant === 'text' && (int) $lines > 1)
    <div {{ $attributes->except('class')->merge(['class' => 'space-y-2.5 w-full']) }} role="status" aria-label="{{ __('prisma::messages.loading') }}">
        @for ($i = 0; $i < (int) $lines; $i++)
            @php
                $lineWidth = $width ?? ($i === (int) $lines - 1 ? 'w-4/5' : 'w-full');
                $itemClass = \ServicioLineaOnce\Prisma11\Support\TailwindClassMerge::merge(
                    $baseClasses,
                    $animationClass,
                    $shapeClasses,
                    $lineWidth
                );
            @endphp
            <div class="{{ $itemClass }}"></div>
        @endfor
        <span class="sr-only">{{ __('prisma::messages.loading') }}</span>
    </div>
@else
    @php
        $defaultWidth = $width ?? ($resolvedVariant === 'text' ? 'w-full' : '');
        $mergedClasses = \ServicioLineaOnce\Prisma11\Support\TailwindClassMerge::merge(
            $baseClasses,
            $animationClass,
            $shapeClasses,
            $defaultWidth,
            $attributes->get('class')
        );
    @endphp
    <div {{ $attributes->except('class')->merge(['class' => $mergedClasses]) }} role="status" aria-label="{{ __('prisma::messages.loading') }}">
        <span class="sr-only">{{ __('prisma::messages.loading') }}</span>
    </div>
@endif
