@props([
    'items' => [],
])

<nav aria-label="Breadcrumb" class="flex items-center text-sm" {{ $attributes }}>
    <ol class="flex items-center gap-1.5 flex-wrap">
        @foreach ($items as $index => $item)
            @php
                $isLast = $index === count($items) - 1;
                $hasUrl = !empty($item['url']);
            @endphp

            <li class="inline-flex items-center gap-1.5">
                @if ($index > 0)
                    <x-prisma-icon name="chevron-right" size="xs" class="text-secondary/60 shrink-0" />
                @endif

                @if ($hasUrl && !$isLast)
                    <a
                        href="{{ $item['url'] }}"
                        class="text-secondary hover:text-primary transition-colors font-medium"
                    >
                        {{ $item['label'] }}
                    </a>
                @else
                    <span
                        class="font-semibold text-dark dark:text-light"
                        @if ($isLast) aria-current="page" @endif
                    >
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
