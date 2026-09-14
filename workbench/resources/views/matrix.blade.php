@php
    $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
@endphp

<!DOCTYPE html>
<html lang="es" class="h-full bg-p11-surface text-p11-surface-content">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prisma 11 - Matriz Cromática</title>
    @prismaStyles
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen p-8 antialiased bg-p11-surface text-p11-surface-content">
    <div class="max-w-7xl mx-auto space-y-12">
        <header class="flex items-center justify-between border-b border-p11-surface-stroke pb-6">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Prisma 11 — Matriz Cromática</h1>
                <p class="text-sm text-p11-muted mt-1">Inspección de los 8 tokens semánticos en componentes atómicos.</p>
            </div>
            <button
                type="button"
                onclick="window.Alpine ? window.Alpine.store('prisma').toggleMode() : document.documentElement.classList.toggle('dark')"
                class="px-4 py-2 text-sm font-semibold rounded-xl border border-p11-surface-stroke bg-p11-surface shadow-sm hover:bg-p11-muted/10 transition-colors"
            >
                Alternar Modo Claro / Oscuro
            </button>
        </header>

        <!-- Botones por Color y Variante -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold">1. Primitiva: Botones</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($colors as $color)
                    <div class="p-4 rounded-xl border border-p11-surface-stroke bg-p11-surface space-y-3">
                        <div class="text-xs font-bold uppercase tracking-wider text-p11-muted">{{ $color }}</div>
                        <div class="flex flex-wrap gap-2">
                            <x-prisma-button :color="$color" variant="solid" size="sm">Solid</x-prisma-button>
                            <x-prisma-button :color="$color" variant="outline" size="sm">Outline</x-prisma-button>
                            <x-prisma-button :color="$color" variant="ghost" size="sm">Ghost</x-prisma-button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Badges por Color -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold">2. Primitiva: Badges</h2>
            <div class="flex flex-wrap gap-3 p-6 rounded-xl border border-p11-surface-stroke bg-p11-surface">
                @foreach ($colors as $color)
                    <x-prisma-badge :color="$color">{{ ucfirst($color) }}</x-prisma-badge>
                @endforeach
            </div>
        </section>

        <!-- Alertas Semánticas -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold">3. Feedback: Alertas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-prisma-alert color="primary" title="Atención Primaria">Notificación del sistema con estilo prioritario.</x-prisma-alert>
                <x-prisma-alert color="success" title="Operación Exitosa">Los cambios fueron sincronizados correctamente.</x-prisma-alert>
                <x-prisma-alert color="warning" title="Advertencia de Límite">Has alcanzado el 85% de tu cuota de almacenamiento.</x-prisma-alert>
                <x-prisma-alert color="danger" title="Error Crítico">No fue posible conectarse con el servidor de pagos.</x-prisma-alert>
            </div>
        </section>

        <!-- Tarjetas y Stats -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold">4. Métricas & Stats</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <x-prisma-stat label="Ingresos Totales" value="$45,231" change="+20.1%" color="success" />
                <x-prisma-stat label="Nuevos Suscriptores" value="2,405" change="+12.5%" color="primary" />
                <x-prisma-stat label="Tasa de Rebote" value="3.1%" change="-0.8%" color="warning" />
                <x-prisma-stat label="Tickets Abiertos" value="14" change="+4" color="danger" />
            </div>
        </section>
    </div>

    @prismaScripts
</body>
</html>
