@props([
    'rating' => 5,
    'max' => 5,
    'count' => null,
    'score' => null,
])

<div class="flex items-center space-x-1 rtl:space-x-reverse">
    @for($i = 1; $i <= $max; $i++)
        <x-prisma-icon
            name="star"
            size="sm"
            class="{{ $i <= (int) $rating ? 'text-yellow-300 fill-yellow-300' : 'text-gray-300 dark:text-gray-500' }}"
        />
    @endfor
    @if($score !== null)
        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded-sm dark:bg-blue-200 dark:text-blue-800 ms-2">
            {{ $score }}
        </span>
    @endif
    @if($count !== null)
        <span class="text-sm font-medium text-gray-500 dark:text-gray-400 ms-2">({{ $count }})</span>
    @endif
</div>
