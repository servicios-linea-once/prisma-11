<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-p11-surface text-p11-surface-content">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Prisma 11 Workbench' }}</title>
    @prismaStyles
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full flex flex-col antialiased">
    <x-prisma-toast />

    <header class="border-b border-p11-surface-stroke bg-p11-surface/80 backdrop-blur sticky top-0 z-40 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="font-bold text-lg text-p11-primary">Prisma 11</span>
            <span class="text-xs px-2 py-0.5 rounded-full bg-p11-primary/10 text-p11-primary font-semibold">Workbench</span>
            <nav class="hidden md:flex items-center gap-4 ms-6 text-sm font-medium">
                <a href="/prisma/matrix" class="hover:text-p11-primary transition-colors">Matriz Cromática</a>
                <a href="/prisma/showcase" class="hover:text-p11-primary transition-colors">Showcase Interactivo</a>
            </nav>
        </div>
        <div class="flex items-center gap-3">
            <button
                type="button"
                @click="$store.prisma.toggleMode()"
                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-p11-surface-stroke hover:bg-p11-muted/10 transition-colors"
            >
                <span x-text="$store.prisma.mode === 'dark' ? '☀️ Claro' : '🌙 Oscuro'"></span>
            </button>
        </div>
    </header>

    <main class="flex-1 p-6 max-w-7xl mx-auto w-full">
        {{ $slot }}
    </main>

    @prismaScripts
</body>
</html>
