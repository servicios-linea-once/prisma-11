@props([
    'sender' => 'Usuario',
    'time' => null,
    'avatar' => null,
    'incoming' => true,
])

<div class="flex items-start gap-2.5 {{ $incoming ? '' : 'flex-row-reverse' }} mb-4">
    @if($avatar)
        <img class="w-8 h-8 rounded-full" src="{{ $avatar }}" alt="{{ $sender }}">
    @else
        <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-xs font-medium text-gray-700 dark:text-gray-300">
            {{ strtoupper(substr($sender, 0, 1)) }}
        </div>
    @endif
    <div class="flex flex-col gap-1 w-full max-w-[320px]">
        <div class="flex items-center space-x-2 {{ $incoming ? '' : 'flex-row-reverse space-x-reverse' }} rtl:space-x-reverse">
            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $sender }}</span>
            @if($time)
                <span class="text-xs font-normal text-gray-500 dark:text-gray-400">{{ $time }}</span>
            @endif
        </div>
        <div class="flex flex-col leading-1.5 p-4 border-gray-200 {{ $incoming ? 'bg-gray-100 dark:bg-gray-700 rounded-e-xl rounded-es-xl' : 'bg-blue-600 text-white rounded-s-xl rounded-ee-xl' }}">
            <p class="text-sm font-normal {{ $incoming ? 'text-gray-900 dark:text-white' : 'text-white' }}">
                {{ $slot }}
            </p>
        </div>
    </div>
</div>
