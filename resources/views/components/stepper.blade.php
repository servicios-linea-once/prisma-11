@props([
    'steps' => [], // array of ['title' => '...', 'active' => bool, 'completed' => bool]
])

<ol {{ $attributes->merge(['class' => 'flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base']) }}>
    @if(!empty($steps))
        @foreach($steps as $idx => $step)
            @php
                $isLast = $loop->last;
                $isCompleted = !empty($step['completed']);
                $isActive = !empty($step['active']);
            @endphp
            <li class="flex items-center {{ $isLast ? '' : 'md:w-full' }} {{ $isActive || $isCompleted ? 'text-blue-600 dark:text-blue-500' : '' }} {{ !$isLast ? 'after:content-[\'\'] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-4 xl:after:mx-8 dark:after:border-gray-700' : '' }}">
                <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                    @if($isCompleted)
                        <span class="me-2 flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 text-xs">
                            <x-prisma-icon name="check" size="xs" />
                        </span>
                    @else
                        <span class="me-2 flex items-center justify-center w-6 h-6 rounded-full {{ $isActive ? 'bg-blue-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-500' }} text-xs">
                            {{ $idx + 1 }}
                        </span>
                    @endif
                    <span class="{{ $isActive ? 'font-semibold' : '' }}">{{ $step['title'] ?? 'Paso' }}</span>
                </span>
            </li>
        @endforeach
    @else
        {{ $slot }}
    @endif
</ol>
