<span {{ $attributes->except('class')->merge(['class' => $classes()]) }}>
    @if ($variant === 'dot')
        <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }} -ms-0.5" aria-hidden="true"></span>
    @endif
    {{ $slot }}
</span>
