<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use ServicioLineaOnce\Prisma11\Tests\TestCase;

class InstallCommandTest extends TestCase
{
    public function test_install_command_runs_successfully(): void
    {
        $this->artisan('prisma:install', [
            '--tailwind' => 'v4',
            '--delivery' => 'zero-build',
            '--prefix' => 'prisma',
            '--force' => true,
        ])
        ->expectsOutputToContain('Prisma 11 instalado y configurado con éxito')
        ->assertSuccessful();
    }

    public function test_install_command_publishes_configuration(): void
    {
        $this->artisan('prisma:install', [
            '--tailwind' => 'v3',
            '--delivery' => 'compiled',
            '--prefix' => 'p11',
            '--force' => true,
        ])
        ->assertSuccessful();

        $this->assertFileExists(config_path('prisma.php'));
    }

    protected function tearDown(): void
    {
        if (file_exists(config_path('prisma.php'))) {
            @unlink(config_path('prisma.php'));
        }

        config(['prisma.prefix' => 'prisma']);

        parent::tearDown();
    }
}
