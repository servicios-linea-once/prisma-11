<!DOCTYPE html>
<html lang="es" class="h-full bg-p11-surface text-p11-surface-content">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prisma 11 — Showcase Interactivo</title>
    @prismaStyles
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen p-8 antialiased bg-p11-surface text-p11-surface-content" x-data>
    <x-prisma-toast />

    <div class="max-w-6xl mx-auto space-y-12">
        <header class="flex items-center justify-between border-b border-p11-surface-stroke pb-6">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Prisma 11 — Laboratorio Interactivo</h1>
                <p class="text-sm text-p11-muted mt-1">Pruebas en vivo de overlays, formularios inteligentes, navegación y toasts.</p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    type="button"
                    @click="$store.prisma.toggleMode()"
                    class="px-4 py-2 text-sm font-semibold rounded-xl border border-p11-surface-stroke bg-p11-surface shadow-sm hover:bg-p11-muted/10 transition-colors"
                >
                    Modo Claro / Oscuro
                </button>
            </div>
        </header>

        <!-- Overlays y Diálogos -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold">1. Overlays & Superposiciones</h2>
            <div class="flex flex-wrap gap-4 p-6 rounded-xl border border-p11-surface-stroke bg-p11-surface">
                <!-- Modal Trigger -->
                <button
                    type="button"
                    @click="$dispatch('open-modal', 'demo-modal')"
                    class="px-4 py-2 bg-p11-primary text-p11-primary-fg rounded-lg font-medium shadow-sm hover:opacity-90 transition-opacity"
                >
                    Abrir Modal Teleport
                </button>

                <!-- Slide-over Trigger -->
                <button
                    type="button"
                    @click="$dispatch('open-slide-over', 'demo-drawer')"
                    class="px-4 py-2 bg-p11-secondary text-p11-secondary-fg rounded-lg font-medium shadow-sm hover:opacity-90 transition-opacity"
                >
                    Abrir Slide-over Drawer
                </button>

                <!-- Toast Trigger -->
                <button
                    type="button"
                    @click="window.dispatchEvent(new CustomEvent('prisma:toast', { detail: { title: '¡Guardado!', message: 'Los cambios fueron aplicados en tiempo real.', type: 'success' } }))"
                    class="px-4 py-2 bg-p11-success text-p11-success-fg rounded-lg font-medium shadow-sm hover:opacity-90 transition-opacity"
                >
                    Disparar Toast Reactivo
                </button>

                <!-- Dropdown -->
                <x-prisma-dropdown>
                    <x-slot:trigger>
                        <button type="button" class="px-4 py-2 border border-p11-surface-stroke rounded-lg font-medium flex items-center gap-2">
                            Opciones de Cuenta
                            <x-prisma-icon name="chevron-down" class="w-4 h-4" />
                        </button>
                    </x-slot:trigger>
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-p11-muted/10">Mi Perfil</a>
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-p11-muted/10">Ajustes</a>
                    <div class="border-t border-p11-surface-stroke my-1"></div>
                    <a href="#" class="block px-4 py-2 text-sm text-p11-danger hover:bg-p11-danger/10">Cerrar Sesión</a>
                </x-prisma-dropdown>
            </div>

            <!-- Modal Declaración -->
            <x-prisma-modal name="demo-modal" title="Confirmación Requerida">
                <p class="text-sm text-p11-muted">
                    Esta ventana modal se renderiza al final de &lt;body&gt; mediante <code>x-teleport</code>, cuenta con Focus Trap accesible y se cierra al presionar Escape o clic afuera.
                </p>
                <x-slot:footer>
                    <x-prisma-button @click="show = false" variant="ghost">Cancelar</x-prisma-button>
                    <x-prisma-button @click="show = false" color="primary">Aceptar y Continuar</x-prisma-button>
                </x-slot:footer>
            </x-prisma-modal>

            <!-- Slide-over Declaración -->
            <x-prisma-slide-over name="demo-drawer" title="Panel Lateral de Configuración">
                <div class="space-y-4 text-sm text-p11-muted">
                    <p>Este panel lateral utiliza transiciones suaves e interacción con teclado.</p>
                    <x-prisma-switch name="notifications" label="Recibir notificaciones push" :checked="true" />
                    <x-prisma-switch name="dark_mode_auto" label="Sincronización automática de tema" />
                </div>
            </x-prisma-slide-over>
        </section>

        <!-- Formularios Inteligentes -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold">2. Formularios Inteligentes</h2>
            <div class="p-6 rounded-xl border border-p11-surface-stroke bg-p11-surface space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-prisma-input name="user_name" label="Nombre Completo" placeholder="Ej: Carlos Silva" />
                    <x-prisma-input name="email" type="email" label="Correo Corporativo" placeholder="carlos@empresa.com" />
                </div>

                <x-prisma-textarea name="bio" label="Biografía Profesional" rows="3" placeholder="Describe brevemente tu trayectoria..." />

                <div class="flex flex-wrap gap-6 items-center">
                    <x-prisma-checkbox name="agree_terms" label="Acepto los términos y condiciones de servicio" />
                    <x-prisma-switch name="subscribe" label="Suscribirme al boletín técnico semanal" />
                </div>
            </div>
        </section>

        <!-- Tabla y Paginación -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold">3. Tabla de Datos y Paginación</h2>
            <x-prisma-table :striped="true" :hover="true">
                <x-slot:head>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Plan</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </x-slot:head>
                <tr>
                    <td class="font-mono text-xs">#USR-101</td>
                    <td class="font-medium">Elena Morales</td>
                    <td>Empresarial</td>
                    <td><x-prisma-badge color="success">Activo</x-prisma-badge></td>
                    <td><x-prisma-button size="xs" variant="ghost">Editar</x-prisma-button></td>
                </tr>
                <tr>
                    <td class="font-mono text-xs">#USR-102</td>
                    <td class="font-medium">Andrés Rivas</td>
                    <td>Pro Anual</td>
                    <td><x-prisma-badge color="warning">Pendiente</x-prisma-badge></td>
                    <td><x-prisma-button size="xs" variant="ghost">Editar</x-prisma-button></td>
                </tr>
                <x-slot:footer>
                    <x-prisma-pagination :current-page="1" :total-pages="5" :total-items="50" :per-page="10" />
                </x-slot:footer>
            </x-prisma-table>
        </section>
    </div>

    @prismaScripts
</body>
</html>
