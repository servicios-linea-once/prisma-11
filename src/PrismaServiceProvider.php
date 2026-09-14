<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use ServicioLineaOnce\Prisma11\Commands\InstallCommand;
use ServicioLineaOnce\Prisma11\Commands\DoctorCommand;
use ServicioLineaOnce\Prisma11\Commands\EjectCommand;

class PrismaServiceProvider extends ServiceProvider
{
    /**
     * Registra los servicios y fusiones de configuración del paquete.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/prisma.php',
            'prisma'
        );
    }

    /**
     * Arranca las vistas, directivas Blade, traducciones y assets.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'prisma');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'prisma');

        $this->registerBladeDirectives();
        $this->registerBladeComponents();
        $this->registerPublishing();
        $this->registerCommands();
    }

    /**
     * Registra las directivas Blade personalizadas del paquete.
     */
    protected function registerBladeDirectives(): void
    {
        Blade::directive('prismaStyles', function () {
            return "<?php echo view('prisma::directives.styles')->render(); ?>";
        });

        Blade::directive('prismaScripts', function () {
            return "<?php echo view('prisma::directives.scripts')->render(); ?>";
        });
    }

    /**
     * Registra el namespace y los componentes Blade según el prefijo configurado.
     */
    protected function registerBladeComponents(): void
    {
        $prefix = (string) config('prisma.prefix', 'prisma');

        // Registro de componentes con clase PHP
        Blade::componentNamespace('ServicioLineaOnce\\Prisma11\\View\\Components', $prefix);

        // Registro automático de componentes anónimos en resources/views/components
        $componentsPath = __DIR__ . '/../resources/views/components';
        if (is_dir($componentsPath)) {
            Blade::anonymousComponentPath($componentsPath, $prefix);

            // Si el prefijo principal es 'prisma', también registrar alias 'p11' para conveniencia
            if ($prefix === 'prisma') {
                Blade::anonymousComponentPath($componentsPath, 'p11');
            }
        }
    }

    /**
     * Configura la publicación de archivos para artisan vendor:publish.
     */
    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/prisma.php' => config_path('prisma.php'),
            ], 'prisma-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/prisma'),
            ], 'prisma-views');

            $this->publishes([
                __DIR__ . '/../lang' => $this->app->langPath('vendor/prisma'),
            ], 'prisma-translations');

            $this->publishes([
                __DIR__ . '/../resources/css' => resource_path('css/vendor/prisma'),
                __DIR__ . '/../resources/js' => resource_path('js/vendor/prisma'),
            ], 'prisma-assets');
        }
    }

    /**
     * Registra los comandos Artisan del paquete.
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $commands = [];

            if (class_exists(InstallCommand::class)) {
                $commands[] = InstallCommand::class;
            }
            if (class_exists(DoctorCommand::class)) {
                $commands[] = DoctorCommand::class;
            }
            if (class_exists(EjectCommand::class)) {
                $commands[] = EjectCommand::class;
            }

            if (!empty($commands)) {
                $this->commands($commands);
            }
        }
    }
}
