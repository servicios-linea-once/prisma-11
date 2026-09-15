<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Commands;

use Illuminate\Console\Command;

class DoctorCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'prisma:doctor';

    /**
     * @var string
     */
    protected $description = 'Audita el entorno y diagnostica la configuración de Tailwind, Alpine y Livewire';

    public function handle(): int
    {
        $this->line('');
        $this->info('  ╔═══════════════════════════════════════════════════════╗');
        $this->info('  ║            PRISMA 11 - DIAGNÓSTICO DEL SISTEMA        ║');
        $this->info('  ╚═══════════════════════════════════════════════════════╝');
        $this->line('');

        $checks = [
            $this->checkPhpVersion(),
            $this->checkLaravelVersion(),
            $this->checkConfiguration(),
            $this->checkDirectives(),
            $this->checkTailwind(),
            $this->checkLivewire(),
            $this->checkAlpine(),
            $this->checkComponentPrefixes(),
            $this->checkIconEngine(),
        ];

        $tableRows = [];
        $hasErrors = false;
        $hasWarnings = false;

        foreach ($checks as $check) {
            $statusLabel = match ($check['status']) {
                'ok' => '<info>✔ CORRECTO</info>',
                'warn' => '<comment>⚠ ADVERTENCIA</comment>',
                'error' => '<fg=red;options=bold>✘ ERROR</>',
            };

            if ($check['status'] === 'error') {
                $hasErrors = true;
            } elseif ($check['status'] === 'warn') {
                $hasWarnings = true;
            }

            $tableRows[] = [$check['item'], $statusLabel, $check['details']];
        }

        $this->table(['Componente / Verificación', 'Estado', 'Detalles'], $tableRows);
        $this->line('');

        if ($hasErrors) {
            $this->error('  Se detectaron problemas críticos que deben resolverse para el correcto funcionamiento.');
            return self::FAILURE;
        }

        if ($hasWarnings) {
            $this->comment('  Se detectaron advertencias menores. Revisa las recomendaciones sugeridas.');
        } else {
            $this->info('  ¡Todo en orden! El entorno de Prisma 11 está configurado de forma óptima.');
        }

        return self::SUCCESS;
    }

    /**
     * @return array{item: string, status: 'ok'|'warn'|'error', details: string}
     */
    protected function checkPhpVersion(): array
    {
        $version = PHP_VERSION;
        if (version_compare($version, '8.2.0', '>=')) {
            return [
                'item' => 'Versión de PHP',
                'status' => 'ok',
                'details' => "PHP {$version} (requerido >= 8.2)",
            ];
        }

        return [
            'item' => 'Versión de PHP',
            'status' => 'error',
            'details' => "PHP {$version} no es compatible. Prisma 11 requiere PHP 8.2 o superior.",
        ];
    }

    /**
     * @return array{item: string, status: 'ok'|'warn'|'error', details: string}
     */
    protected function checkLaravelVersion(): array
    {
        /** @var \Illuminate\Contracts\Foundation\Application $app */
        $app = app();
        $version = $app->version();
        return [
            'item' => 'Framework Laravel',
            'status' => 'ok',
            'details' => "Laravel {$version}",
        ];
    }

    /**
     * @return array{item: string, status: 'ok'|'warn'|'error', details: string}
     */
    protected function checkConfiguration(): array
    {
        $configPath = config_path('prisma.php');
        if (file_exists($configPath)) {
            $prefixVal = config('prisma.prefix');
            $prefix = is_string($prefixVal) ? $prefixVal : 'prisma';
            $themeVal = config('prisma.theme');
            $theme = is_string($themeVal) ? $themeVal : 'default';
            return [
                'item' => 'Archivo config/prisma.php',
                'status' => 'ok',
                'details' => "Publicado. Prefijo: '<x-{$prefix}-*>', Tema: '{$theme}'",
            ];
        }

        return [
            'item' => 'Archivo config/prisma.php',
            'status' => 'warn',
            'details' => "No publicado (usando defaults en memoria). Ejecuta 'php artisan prisma:install'.",
        ];
    }

    /**
     * @return array{item: string, status: 'ok'|'warn'|'error', details: string}
     */
    protected function checkDirectives(): array
    {
        $viewsPath = resource_path('views');
        if (!is_dir($viewsPath)) {
            return [
                'item' => 'Directivas @prismaStyles y @prismaScripts',
                'status' => 'warn',
                'details' => 'No se encontró el directorio resources/views para escanear layouts.',
            ];
        }

        $foundStyles = false;
        $foundScripts = false;

        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($viewsPath));
        /** @var \SplFileInfo $file */
        foreach ($files as $file) {
            if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
                $content = @file_get_contents($file->getPathname()) ?: '';
                if (str_contains($content, '@prismaStyles')) {
                    $foundStyles = true;
                }
                if (str_contains($content, '@prismaScripts')) {
                    $foundScripts = true;
                }
                if ($foundStyles && $foundScripts) {
                    break;
                }
            }
        }

        if ($foundStyles && $foundScripts) {
            return [
                'item' => 'Directivas Blade (@prismaStyles / @prismaScripts)',
                'status' => 'ok',
                'details' => 'Detectadas en las plantillas del proyecto.',
            ];
        }

        return [
            'item' => 'Directivas Blade (@prismaStyles / @prismaScripts)',
            'status' => 'warn',
            'details' => 'Asegúrate de incluir @prismaStyles en <head> y @prismaScripts antes de </body> en tu layout.',
        ];
    }

    /**
     * @return array{item: string, status: 'ok'|'warn'|'error', details: string}
     */
    protected function checkTailwind(): array
    {
        $base = base_path();
        $hasV3Config = file_exists("{$base}/tailwind.config.js") ||
                       file_exists("{$base}/tailwind.config.ts") ||
                       file_exists("{$base}/tailwind.config.cjs");

        $cssPath = resource_path('css/app.css');
        $hasV4Theme = false;

        if (file_exists($cssPath)) {
            $cssContent = (string) file_get_contents($cssPath);
            if (str_contains($cssContent, '@import "tailwindcss"') || str_contains($cssContent, '@theme') || str_contains($cssContent, '@source')) {
                $hasV4Theme = true;
            }
        }

        if ($hasV4Theme) {
            return [
                'item' => 'Tailwind CSS',
                'status' => 'ok',
                'details' => 'Tailwind CSS v4 detectado (@theme / @source en app.css).',
            ];
        }

        if ($hasV3Config) {
            $configFilename = file_exists("{$base}/tailwind.config.js") ? "{$base}/tailwind.config.js" :
                (file_exists("{$base}/tailwind.config.ts") ? "{$base}/tailwind.config.ts" : "{$base}/tailwind.config.cjs");
            $configContent = (string) file_get_contents($configFilename);

            if (str_contains($configContent, 'servicio-linea-once/prisma-11') || str_contains($configContent, 'prisma-11')) {
                return [
                    'item' => 'Tailwind CSS',
                    'status' => 'ok',
                    'details' => 'Tailwind CSS v3 detectado y escaneando vistas de Prisma 11 en content.',
                ];
            }

            return [
                'item' => 'Tailwind CSS',
                'status' => 'warn',
                'details' => 'Tailwind v3 detectado. Recuerda agregar "./vendor/servicio-linea-once/prisma-11/resources/views/**/*.blade.php" en content de tailwind.config.js para compilar estilos.',
            ];
        }

        return [
            'item' => 'Tailwind CSS',
            'status' => 'warn',
            'details' => 'No se detectó configuración de Tailwind. Asegúrate de incluir el preset o archivo CSS de Prisma.',
        ];
    }

    /**
     * @return array{item: string, status: 'ok'|'warn'|'error', details: string}
     */
    protected function checkLivewire(): array
    {
        if (class_exists(\Livewire\Livewire::class)) {
            $version = defined('\Livewire\Livewire::VERSION') ? (string) constant('\Livewire\Livewire::VERSION') : '3.x';
            return [
                'item' => 'Livewire Integration',
                'status' => 'ok',
                'details' => "Livewire v{$version} instalado y listo para reactividad.",
            ];
        }

        return [
            'item' => 'Livewire Integration',
            'status' => 'ok',
            'details' => 'Livewire no detectado (opcional, componentes operan en modo Blade clásico).',
        ];
    }

    /**
     * @return array{item: string, status: 'ok'|'warn'|'error', details: string}
     */
    protected function checkAlpine(): array
    {
        return [
            'item' => 'Alpine.js',
            'status' => 'ok',
            'details' => 'Store reactivo gestionado automáticamente por @prismaScripts.',
        ];
    }

    /**
     * @return array{item: string, status: 'ok'|'warn'|'error', details: string}
     */
    protected function checkComponentPrefixes(): array
    {
        $prefixVal = config('prisma.prefix');
        $prefix = is_string($prefixVal) && $prefixVal !== '' ? $prefixVal : 'prisma';

        return [
            'item' => 'Prefijo de Componentes',
            'status' => 'ok',
            'details' => "Prefijo activo: '<x-{$prefix}-*>' (alias '<x-p11-*>', '<x-prisma-*>')",
        ];
    }

    /**
     * @return array{item: string, status: 'ok'|'warn'|'error', details: string}
     */
    protected function checkIconEngine(): array
    {
        $driverVal = config('prisma.icons.driver');
        $driver = is_string($driverVal) ? $driverVal : 'iconify';
        $setVal = config('prisma.icons.default_set');
        $set = is_string($setVal) ? $setVal : 'lucide';

        return [
            'item' => 'Motor de Iconos',
            'status' => 'ok',
            'details' => "Driver: '{$driver}', Colección por defecto: '{$set}' (Iconify integrado)",
        ];
    }
}
