<div class="relative inline-block shrink-0">
    <div {{ $attributes->except('class')->merge(['class' => $classes()]) }}>
        @if ($src)
            <img src="{{ $src }}" alt="{{ $name ?? 'Avatar' }}" class="w-full h-full object-cover" />
        @elseif ($name)
            <span class="font-semibold text-secondary-dark dark:text-light">{{ $initials() }}</span>
        @else
            <x-prisma-icon name="user" size="{{ $size }}" class="text-secondary" />
        @endif
    </div>

    @if ($status)
        <span class="{{ $statusClasses() }}" aria-hidden="true"></span>
    @endif
</div>
