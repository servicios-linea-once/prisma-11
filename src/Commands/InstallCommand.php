<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\intro;
use function Laravel\Prompts\select;
use function Laravel\Prompts\table;
use function Laravel\Prompts\outro;

class InstallCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'prisma:install
                            {--tailwind= : Versión de Tailwind CSS (v3 o v4)}
                            {--delivery= : Modo de entrega (zero-build o compiled)}
                            {--prefix= : Prefijo para componentes Blade (prisma o p11)}
                            {--force : Sobrescribir configuración existente}';

    /**
     * @var string
     */
    protected $description = 'Instala y configura interactivamente Prisma 11 en tu aplicación Laravel';

    public function handle(): int
    {
        $isInteractive = $this->input->isInteractive();

        if ($isInteractive && !$this->option('tailwind') && function_exists('Laravel\Prompts\intro')) {
            intro('Prisma 11 — Asistente Guiado de Instalación');
        }

        // 1. Versión de Tailwind CSS
        $optTailwind = $this->option('tailwind');
        $tailwind = is_string($optTailwind) ? $optTailwind : '';
        if (!in_array($tailwind, ['v3', 'v4'], true)) {
            if ($isInteractive && function_exists('Laravel\Prompts\select')) {
                $selected = select(
                    label: '¿Qué versión de Tailwind CSS utilizas en este proyecto?',
                    options: [
                        'v4' => 'Tailwind CSS v4 (Recomendado — directivas @theme y @source nativas)',
                        'v3' => 'Tailwind CSS v3 (vía archivo preset.js en tailwind.config.js)',
                    ],
                    default: 'v4'
                );
                $tailwind = is_string($selected) ? $selected : 'v4';
            } else {
                $tailwind = 'v4';
            }
        }

        // 2. Modo de Entrega de Scripts y Estilos
        $optDelivery = $this->option('delivery');
        $delivery = is_string($optDelivery) ? $optDelivery : '';
        if (!in_array($delivery, ['zero-build', 'compiled'], true)) {
            if ($isInteractive && function_exists('Laravel\Prompts\select')) {
                $selected = select(
                    label: '¿Cuál es tu método de entrega preferido para assets?',
                    options: [
                        'zero-build' => 'Zero-build (Recomendado — Inyección en runtime con @prismaStyles y @prismaScripts)',
                        'compiled' => 'Módulo Compilado (Vite / ES Modules empaquetados)',
                    ],
                    default: 'zero-build'
                );
                $delivery = is_string($selected) ? $selected : 'zero-build';
            } else {
                $delivery = 'zero-build';
            }
        }

        // 3. Prefijo de Componentes Blade
        $optPrefix = $this->option('prefix');
        $prefix = is_string($optPrefix) ? $optPrefix : '';
        if (!in_array($prefix, ['prisma', 'p11'], true)) {
            if ($isInteractive && function_exists('Laravel\Prompts\select')) {
                $selected = select(
                    label: 'Selecciona el prefijo para los componentes Blade:',
                    options: [
                        'p11' => 'Ultra compacto: <x-p11-button>',
                        'prisma' => 'Estándar didáctico: <x-prisma-button>',
                    ],
                    default: 'p11'
                );
                $prefix = is_string($selected) ? $selected : 'p11';
            } else {
                $prefix = 'p11';
            }
        }

        // 4. Publicar Configuración
        $this->call('vendor:publish', [
            '--tag' => 'prisma-config',
            '--force' => (bool) $this->option('force'),
        ]);

        if ($delivery === 'compiled') {
            $this->call('vendor:publish', [
                '--tag' => 'prisma-assets',
                '--force' => (bool) $this->option('force'),
            ]);
        }

        // 5. Actualizar archivo de configuración publicado si existe
        $configPath = config_path('prisma.php');
        if (file_exists($configPath)) {
            $content = (string) file_get_contents($configPath);
            $content = preg_replace(
                "/'prefix' => env\('PRISMA_PREFIX', '.*?'\)/",
                "'prefix' => env('PRISMA_PREFIX', '{$prefix}')",
                $content
            ) ?? $content;

            $content = preg_replace(
                "/'delivery' => env\('PRISMA_DELIVERY', '.*?'\)/",
                "'delivery' => env('PRISMA_DELIVERY', '{$delivery}')",
                $content
            ) ?? $content;

            file_put_contents($configPath, $content);
        }

        // 6. Verificar y sugerir contenido de Tailwind CSS
        $tailwindFile = base_path('tailwind.config.js');
        if (file_exists($tailwindFile)) {
            $twContent = (string) file_get_contents($tailwindFile);
            if (!str_contains($twContent, 'prisma-11')) {
                $this->warn('Para que Tailwind no purgue las clases de Flowbite, agrega a content en tailwind.config.js:');
                $this->line("  './vendor/servicio-linea-once/prisma-11/resources/views/**/*.blade.php',");
                $this->line("  './vendor/servicio-linea-once/prisma-11/src/**/*.php',");
            }
        }

        // 7. Resumen didáctico
        if ($isInteractive && function_exists('Laravel\Prompts\table')) {
            /** @var array<int, array<int, string>> $rows */
            $rows = [
                ['Tailwind CSS', (string) ($tailwind === 'v4' ? 'v4 (@theme & @source)' : 'v3 (preset.js)')],
                ['Modo de entrega', (string) $delivery],
                ['Prefijo Blade', (string) "<x-{$prefix}-...>"],
                ['Archivo config', 'config/prisma.php'],
            ];
            table(
                headers: ['Parámetro', 'Valor Configurado'],
                rows: $rows
            );
        }

        $this->info('Prisma 11 instalado y configurado con éxito.');
        $this->line('');
        $this->line('Próximos pasos sugeridos:');
        $this->line('1. Inyecta @prismaStyles y @prismaScripts en el <head> de tu layout principal.');
        $this->line("2. Prueba un componente en Blade: <x-{$prefix}-button color=\"primary\">Hola Prisma 11</x-{$prefix}-button>");
        $this->line('3. Ejecuta "php artisan prisma:doctor" para verificar la salud de tu instalación.');

        if ($isInteractive && function_exists('Laravel\Prompts\outro')) {
            outro('¡Listo para construir interfaces de alta gama!');
        }

        return self::SUCCESS;
    }
}
