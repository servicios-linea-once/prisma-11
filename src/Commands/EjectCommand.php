<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;
use function Laravel\Prompts\info;
use function Laravel\Prompts\error;

class EjectCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'prisma:eject
                            {component? : Nombre específico del componente a expulsar (ej: button, card, modal)}
                            {--all : Expulsa todos los componentes a la aplicación local}
                            {--force : Sobrescribe componentes existentes sin pedir confirmación}';

    /**
     * @var string
     */
    protected $description = 'Expulsa los componentes Blade y clases PHP hacia la aplicación local para control y personalización total';

    /**
     * Mapa de clases PHP asociadas a componentes.
     *
     * @var array<string, string>
     */
    protected array $classMap = [
        'button' => 'Button.php',
        'badge' => 'Badge.php',
        'avatar' => 'Avatar.php',
        'spinner' => 'Spinner.php',
        'icon' => 'Icon.php',
        'input' => 'Input.php',
        'textarea' => 'Textarea.php',
        'checkbox' => 'Checkbox.php',
        'radio' => 'Radio.php',
        'switch' => 'SwitchToggle.php',
        'alert' => 'Alert.php',
        'toast' => 'Toast.php',
    ];

    public function handle(): int
    {
        $this->line('');
        $this->info('  ╔═══════════════════════════════════════════════════════╗');
        $this->info('  ║            PRISMA 11 - EXPULSIÓN DE COMPONENTES       ║');
        $this->info('  ╚═══════════════════════════════════════════════════════╝');
        $this->line('');

        $rawComponent = $this->argument('component');
        $componentName = is_string($rawComponent) && trim($rawComponent) !== '' ? trim($rawComponent) : null;
        $ejectAll = (bool) $this->option('all');
        $force = (bool) $this->option('force');

        $availableComponents = $this->getAvailableComponents();
        /** @var array<int, string> $selected */
        $selected = [];

        if ($ejectAll) {
            $selected = $availableComponents;
        } elseif ($componentName !== null) {
            $normalized = strtolower($componentName);
            if (!in_array($normalized, $availableComponents, true)) {
                $this->error("El componente '{$componentName}' no existe en Prisma 11.");
                $this->line('Componentes disponibles: ' . implode(', ', $availableComponents));
                return self::FAILURE;
            }
            $selected = [$normalized];
        } else {
            if (!$this->input->isInteractive()) {
                $this->error('Debes especificar un componente o utilizar la bandera --all.');
                return self::FAILURE;
            }

            $choices = array_merge(['[TODOS LOS COMPONENTES]'], $availableComponents);
            $choice = select(
                label: '¿Qué componente deseas expulsar hacia tu proyecto local?',
                options: $choices,
                default: '[TODOS LOS COMPONENTES]'
            );

            if ($choice === '[TODOS LOS COMPONENTES]') {
                $selected = $availableComponents;
            } else {
                $selected = [(string) $choice];
            }
        }

        if (!$force && $this->input->isInteractive()) {
            $confirmed = confirm(
                label: "¿Estás seguro de que deseas copiar " . count($selected) . " componente(s) a tu directorio local?",
                default: true
            );

            if (!$confirmed) {
                $this->comment('Expulsión cancelada por el usuario.');
                return self::SUCCESS;
            }
        }

        $ejectedCount = 0;
        foreach ($selected as $name) {
            $this->ejectComponent((string) $name);
            $ejectedCount++;
        }

        $this->line('');
        $this->info("✔ ¡Expulsión completada! Se copiaron {$ejectedCount} componente(s) a tu aplicación.");
        $this->line('  • Vistas Blade: resources/views/components/prisma/');
        $this->line('  • Clases PHP:   app/View/Components/Prisma/');
        $this->line('');
        $this->comment("  Tip: Ahora puedes registrar tus componentes locales en AppServiceProvider o llamarlos como <x-prisma.[nombre]>");
        $this->line('');

        return self::SUCCESS;
    }

    /**
     * @return array<int, string>
     */
    protected function getAvailableComponents(): array
    {
        $viewsPath = __DIR__ . '/../../resources/views/components';
        $files = glob($viewsPath . '/*.blade.php') ?: [];
        $components = [];

        foreach ($files as $file) {
            $components[] = basename($file, '.blade.php');
        }

        sort($components);
        return $components;
    }

    protected function ejectComponent(string $name): void
    {
        $viewsSrc = __DIR__ . "/../../resources/views/components/{$name}.blade.php";
        $viewsDestDir = resource_path('views/components/prisma');
        $viewsDest = "{$viewsDestDir}/{$name}.blade.php";

        if (!is_dir($viewsDestDir)) {
            @mkdir($viewsDestDir, 0755, true);
        }

        if (file_exists($viewsSrc)) {
            $content = (string) file_get_contents($viewsSrc);
            // Reescribe referencias de prefijo de paquete a referencias locales si aplica
            $content = str_replace('prisma::components.', 'components.prisma.', $content);
            file_put_contents($viewsDest, $content);
            $this->line("  [Copiado] Vista Blade: {$name}.blade.php");
        }

        if (isset($this->classMap[$name])) {
            $fileName = $this->classMap[$name];
            $classSrc = __DIR__ . "/../View/Components/{$fileName}";
            $classDestDir = app_path('View/Components/Prisma');
            $classDest = "{$classDestDir}/{$fileName}";

            if (!is_dir($classDestDir)) {
                @mkdir($classDestDir, 0755, true);
            }

            if (file_exists($classSrc)) {
                $content = (string) file_get_contents($classSrc);

                // Reescribe namespace para el proyecto anfitrión
                $content = str_replace(
                    'namespace ServicioLineaOnce\Prisma11\View\Components;',
                    'namespace App\View\Components\Prisma;' . PHP_EOL . 'use ServicioLineaOnce\Prisma11\View\Components\BaseComponent;',
                    $content
                );

                // Reescribe referencia a vista Blade del componente
                $content = str_replace(
                    'prisma::components.',
                    'components.prisma.',
                    $content
                );

                file_put_contents($classDest, $content);
                $this->line("  [Copiado] Clase PHP: {$fileName}");
            }
        }
    }
}
