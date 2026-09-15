@props([
    'src' => null,
    'controls' => true,
    'autoplay' => false,
    'loop' => false,
    'muted' => false,
])

<div class="w-full max-w-full rounded-lg overflow-hidden shadow-md">
    @if($src)
        <video
            class="w-full rounded-lg"
            @if($controls) controls @endif
            @if($autoplay) autoplay @endif
            @if($loop) loop @endif
            @if($muted) muted @endif
        >
            <source src="{{ $src }}" type="video/mp4">
            Tu navegador no soporta la etiqueta de video.
        </video>
    @else
        <div class="relative pb-[56.25%] h-0 overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full">
                {{ $slot }}
            </div>
        </div>
    @endif
</div>
