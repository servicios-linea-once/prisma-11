<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use ServicioLineaOnce\Prisma11\PrismaServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            PrismaServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        // Setup default configuration for tests
        $app['config']->set('app.key', 'base64:Hupx3yAyWxxx/zHoxxWOPxxZxxQx7xxVxx+x1xx5xx8=');

        $workbenchViews = __DIR__ . '/../workbench/resources/views';
        if (is_dir($workbenchViews)) {
            $app['view']->addNamespace('workbench', $workbenchViews);
        }
    }

    protected function defineRoutes($router): void
    {
        $routesFile = __DIR__ . '/../workbench/routes/web.php';
        if (file_exists($routesFile)) {
            require $routesFile;
        }
    }
}
