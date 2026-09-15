<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prisma 11 — Showcase Interactivo</title>
    @prismaStyles
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa',
                            500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex flex-col antialiased" x-data="{ darkMode: false, activeTab: 'all' }" :class="{ 'dark': darkMode }">
    <x-p11-toast />

    <!-- Top Navbar -->
    <header class="sticky top-0 z-40 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 flex items-center justify-between shadow-xs">
        <div class="flex items-center gap-3">
            <span class="text-xl font-bold text-blue-600 dark:text-blue-500">Prisma 11</span>
            <span class="text-xs px-2 py-0.5 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 font-semibold">UI Components</span>
        </div>
        <div class="flex items-center gap-3">
            <button
                type="button"
                @click="darkMode = !darkMode"
                class="p-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium flex items-center gap-2 cursor-pointer"
            >
                <x-prisma-icon name="moon" size="xs" x-show="!darkMode" />
                <x-prisma-icon name="sun" size="xs" x-show="darkMode" />
                <span x-text="darkMode ? 'Modo Claro' : 'Modo Oscuro'"></span>
            </button>
        </div>
    </header>

    <div class="flex-1 flex overflow-hidden">
        <!-- Prisma 11 Sidebar -->
        <aside class="w-64 border-e border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 overflow-y-auto p-4 hidden md:block shrink-0">
            <nav class="space-y-6 text-sm">
                <!-- COMPONENTS -->
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">COMPONENTS</h5>
                    <ul class="space-y-1 font-medium">
                        <li><a href="#buttons" class="block px-2 py-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700 text-blue-600 dark:text-blue-400 font-semibold">Buttons & Groups</a></li>
                        <li><a href="#badges" class="block px-2 py-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Badges & Indicators</a></li>
                        <li><a href="#alerts" class="block px-2 py-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Alerts & Banner</a></li>
                        <li><a href="#overlays" class="block px-2 py-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Modal, Drawer & Popover</a></li>
                        <li><a href="#navigation" class="block px-2 py-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Navbar, Tabs & Breadcrumb</a></li>
                        <li><a href="#media" class="block px-2 py-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Carousel, Chat & Mockups</a></li>
                    </ul>
                </div>

                <!-- FORMS -->
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">FORMS</h5>
                    <ul class="space-y-1 font-medium">
                        <li><a href="#forms" class="block px-2 py-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Input, File & Search</a></li>
                        <li><a href="#forms-advanced" class="block px-2 py-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Range, Select & Floating</a></li>
                    </ul>
                </div>

                <!-- TYPOGRAPHY & PLUGINS -->
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">TYPOGRAPHY & PLUGINS</h5>
                    <ul class="space-y-1 font-medium">
                        <li><a href="#typography" class="block px-2 py-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Headings & Quotes</a></li>
                        <li><a href="#datatables" class="block px-2 py-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Datatables & WYSIWYG</a></li>
                    </ul>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6 md:p-10 space-y-12">
            <!-- Jumbotron -->
            <x-p11-jumbotron title="Prisma 11 — Laboratorio Interactivo" description="Biblioteca de componentes UI de alta fidelidad basada en Tailwind CSS + Alpine.js + Iconify con prefijo 100% dinámico.">
                <x-p11-button href="#buttons" color="primary">Ver Componentes</x-p11-button>
                <x-p11-button href="https://github.com/servicios-linea-once/prisma-11" color="alternative" target="_blank">Repositorio GitHub</x-p11-button>
            </x-p11-jumbotron>

            <!-- Buttons & Groups -->
            <section id="buttons" class="space-y-4">
                <h2 class="text-2xl font-bold">Buttons, Button Groups & KBD</h2>
                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 space-y-4">
                    <div class="flex flex-wrap gap-3 items-center">
                        <x-p11-button color="primary">Primary (Blue)</x-p11-button>
                        <x-p11-button color="alternative">Alternative (White)</x-p11-button>
                        <x-p11-button color="success">Success (Green)</x-p11-button>
                        <x-p11-button color="danger">Danger (Red)</x-p11-button>
                        <x-p11-button color="warning">Warning (Yellow)</x-p11-button>
                        <x-p11-button color="primary" rounded="full">Pill Button</x-p11-button>
                        <x-p11-button color="primary" :loading="true">Cargando</x-p11-button>
                    </div>
                    <div class="pt-2 flex flex-wrap gap-4 items-center">
                        <span class="text-sm font-medium">Button Group:</span>
                        <x-p11-button-group>
                            <x-p11-button size="sm">Ayer</x-p11-button>
                            <x-p11-button size="sm">Hoy</x-p11-button>
                            <x-p11-button size="sm">Mañana</x-p11-button>
                        </x-p11-button-group>
                        <span class="text-sm font-medium">Atajos de teclado:</span>
                        <x-p11-kbd>Ctrl</x-p11-kbd> + <x-p11-kbd>K</x-p11-kbd>
                    </div>
                </div>
            </section>

            <!-- Overlays & Superposiciones -->
            <section id="overlays" class="space-y-4">
                <h2 class="text-2xl font-bold">Overlays & Superposiciones</h2>
                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 flex flex-wrap gap-4 items-center">
                    <x-p11-popover title="Info Popover" content="Detalles contextuales de ayuda">
                        <x-p11-button size="sm">Hover Popover</x-p11-button>
                    </x-p11-popover>
                    <x-p11-button size="sm" color="alternative" @click="window.dispatchEvent(new CustomEvent('open-drawer-demo'))">Abrir Drawer</x-p11-button>
                    <x-p11-drawer id="demo" title="Drawer de Ejemplo">Contenido dentro del drawer lateral.</x-p11-drawer>
                </div>
            </section>

            <!-- Badges & Indicators -->
            <section id="badges" class="space-y-4">
                <h2 class="text-2xl font-bold">Badges, Avatars & Indicators</h2>
                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 flex flex-wrap gap-6 items-center">
                    <div class="flex flex-wrap gap-2">
                        <x-p11-badge color="primary">Default</x-p11-badge>
                        <x-p11-badge color="success">Green</x-p11-badge>
                        <x-p11-badge color="danger">Red</x-p11-badge>
                        <x-p11-badge color="warning">Yellow</x-p11-badge>
                        <x-p11-badge color="indigo">Indigo</x-p11-badge>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <x-p11-avatar initials="JS" size="md" />
                            <x-p11-indicator color="green" ping="true" placement="top-right" />
                        </div>
                        <x-p11-rating rating="4" max="5" count="48" score="4.9" />
                    </div>
                </div>
            </section>

            <!-- Alerts & Banner -->
            <section id="alerts" class="space-y-4">
                <h2 class="text-2xl font-bold">Alerts & Banner</h2>
                <div class="space-y-3">
                    <x-p11-alert color="info" :dismissible="true">Información: Componentes nativos de Prisma 11.</x-p11-alert>
                    <x-p11-alert color="success" :dismissible="true">Éxito: Prefijo dinámico y motor de iconos Iconify activos.</x-p11-alert>
                    <x-p11-alert color="warning" :dismissible="true">Advertencia: Recuerda registrar la ruta en tailwind.config.js.</x-p11-alert>
                </div>
            </section>

            <!-- Forms / Formularios Inteligentes -->
            <section id="forms" class="space-y-4">
                <h2 class="text-2xl font-bold">Formularios Inteligentes</h2>
                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-p11-input name="fullname" label="Nombre completo" placeholder="Ej: John Doe" />
                    <x-p11-search-input placeholder="Buscar en el catálogo..." button="Buscar" />
                    <x-p11-phone-input label="Número telefónico" />
                    <x-p11-number-input label="Cantidad de asientos" min="1" max="50" value="5" />
                    <x-p11-select label="Región de despliegue" :options="['us' => 'Estados Unidos', 'eu' => 'Europa', 'latam' => 'Latinoamérica']" />
                    <x-p11-range label="Nivel de zoom" min="0" max="100" showValues="true" />
                    <x-p11-datepicker label="Fecha de inicio" />
                    <x-p11-timepicker label="Hora de reunión" />
                    <div class="col-span-1 md:col-span-2">
                        <x-p11-floating-label label="Input con Floating Label animado" />
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <x-p11-file-input label="Subir archivo" helper="SVG, PNG, JPG o GIF (MAX. 800x400px)" dropzone="true" />
                    </div>
                </div>
            </section>

            <!-- Tabla de Datos y Paginación -->
            <section id="datatables" class="space-y-4">
                <h2 class="text-2xl font-bold">Tabla de Datos y Paginación</h2>
                @php
                    $dtHeaders = ['id' => 'ID', 'name' => 'Nombre', 'role' => 'Rol', 'status' => 'Estado'];
                    $dtRows = [
                        ['id' => '#001', 'name' => 'Elena Morales', 'role' => 'Ingeniera Lead', 'status' => 'Activo'],
                        ['id' => '#002', 'name' => 'Carlos Silva', 'role' => 'Diseñador UI', 'status' => 'En línea'],
                        ['id' => '#003', 'name' => 'Andrés Rivas', 'role' => 'DevOps Specialist', 'status' => 'Ausente'],
                        ['id' => '#004', 'name' => 'Lucía Mendoza', 'role' => 'QA Lead', 'status' => 'Activo'],
                    ];
                @endphp
                <x-p11-datatable :headers="$dtHeaders" :rows="$dtRows" perPage="3" />
            </section>

            <!-- WYSIWYG & Media -->
            <section id="media" class="space-y-4">
                <h2 class="text-2xl font-bold">Media, Timeline & Utilities</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 space-y-4">
                        <h4 class="font-bold">Timeline de Eventos:</h4>
                        <x-p11-timeline>
                            <x-p11-timeline-item date="Septiembre 2026" title="Lanzamiento Prisma 11">
                                Lanzamiento inicial con más de 66 componentes de Prisma 11.
                            </x-p11-timeline-item>
                            <x-p11-timeline-item date="Octubre 2026" title="Integración Iconify">
                                Acceso nativo a más de 200,000 iconos vectoriales.
                            </x-p11-timeline-item>
                        </x-p11-timeline>
                    </div>
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 space-y-4">
                        <h4 class="font-bold">Copiado al Portapapeles & QR:</h4>
                        <div class="flex flex-col gap-4 items-center">
                            <x-p11-clipboard value="composer require servicio-linea-once/prisma-11" />
                            <x-p11-qr-code value="https://github.com/servicios-linea-once/prisma-11" title="Escanea para ver Prisma 11" size="sm" />
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Prisma 11 Footer -->
    <x-p11-footer brand="Prisma 11">
        <li><a href="#buttons" class="hover:underline me-4 md:me-6">Botones</a></li>
        <li><a href="#forms" class="hover:underline me-4 md:me-6">Formularios</a></li>
        <li><a href="#datatables" class="hover:underline">Tablas</a></li>
    </x-p11-footer>

    @prismaScripts
</body>
</html>
