<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use ServicioLineaOnce\Prisma11\Tests\TestCase;

class CliDiagnosticsTest extends TestCase
{
    public function test_doctor_command_runs_successfully(): void
    {
        $this->artisan('prisma:doctor')
            ->expectsOutputToContain('PRISMA 11 - DIAGNÓSTICO DEL SISTEMA')
            ->assertSuccessful();
    }

    public function test_eject_command_ejects_single_component(): void
    {
        $this->artisan('prisma:eject', [
            'component' => 'button',
            '--force' => true,
        ])
        ->expectsOutputToContain('¡Expulsión completada!')
        ->assertSuccessful();

        $this->assertFileExists(resource_path('views/components/prisma/button.blade.php'));
        $this->assertFileExists(app_path('View/Components/Prisma/Button.php'));

        $classContent = (string) file_get_contents(app_path('View/Components/Prisma/Button.php'));
        $this->assertStringContainsString('namespace App\View\Components\Prisma;', $classContent);
        $this->assertStringContainsString("view('components.prisma.button", $classContent);
    }

    public function test_eject_command_rejects_invalid_component(): void
    {
        $this->artisan('prisma:eject', [
            'component' => 'componente-inexistente',
            '--force' => true,
        ])
        ->expectsOutputToContain("El componente 'componente-inexistente' no existe en Prisma 11")
        ->assertFailed();
    }

    protected function tearDown(): void
    {
        $viewsDir = resource_path('views/components/prisma');
        if (is_dir($viewsDir)) {
            $files = glob($viewsDir . '/*') ?: [];
            foreach ($files as $file) {
                @unlink($file);
            }
            @rmdir($viewsDir);
        }

        $classDir = app_path('View/Components/Prisma');
        if (is_dir($classDir)) {
            $files = glob($classDir . '/*') ?: [];
            foreach ($files as $file) {
                @unlink($file);
            }
            @rmdir($classDir);
        }

        parent::tearDown();
    }
}
