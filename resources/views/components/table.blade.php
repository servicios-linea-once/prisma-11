@props([
    'striped' => false,
    'hover' => true,
    'compact' => false,
    'bordered' => true,
])

@php
    $wrapperClasses = \ServicioLineaOnce\Prisma11\Support\TailwindClassMerge::merge(
        'w-full overflow-hidden rounded-xl bg-p11-surface shadow-sm',
        $bordered ? 'border border-p11-surface-stroke' : '',
        $attributes->get('class')
    );

    $tableClasses = 'min-w-full divide-y divide-p11-surface-stroke text-left text-sm text-p11-surface-content';
    $thClasses = 'text-xs font-semibold uppercase tracking-wider text-p11-muted bg-p11-muted/5 ' . ($compact ? 'px-3 py-2.5' : 'px-4 sm:px-6 py-3.5');
    $tbodyClasses = 'divide-y divide-p11-surface-stroke bg-p11-surface ' .
        ($striped ? '[&>tr:nth-child(even)]:bg-p11-muted/[0.02]' : '') . ' ' .
        ($hover ? '[&>tr]:transition-colors [&>tr:hover]:bg-p11-muted/[0.04]' : '');
@endphp

<div {{ $attributes->except('class')->merge(['class' => $wrapperClasses]) }}>
    <div class="overflow-x-auto">
        <table class="{{ $tableClasses }}" role="table">
            @if (isset($head))
                <thead class="{{ $thClasses }}">
                    <tr>
                        {{ $head }}
                    </tr>
                </thead>
            @endif

            <tbody class="{{ $tbodyClasses }}">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if (isset($empty))
        <div class="p-6">
            {{ $empty }}
        </div>
    @endif

    @if (isset($footer))
        <div class="border-t border-p11-surface-stroke bg-p11-muted/5 px-4 sm:px-6 py-3">
            {{ $footer }}
        </div>
    @endif
</div>
