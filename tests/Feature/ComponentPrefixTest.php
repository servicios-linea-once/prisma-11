<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\PrismaServiceProvider;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class ComponentPrefixTest extends TestCase
{
    public function test_toast_renders_successfully_with_p11_prefix(): void
    {
        $rendered = Blade::render('<x-p11-toast position="top-end" />');

        $this->assertStringContainsString('prisma:toast', $rendered);
        $this->assertStringContainsString('role="status"', $rendered);
    }

    public function test_components_work_when_config_prefix_is_set_to_p11(): void
    {
        config(['prisma.prefix' => 'p11']);

        // Re-ejecutar el registro de componentes para simular la carga con prefix=p11
        $provider = new PrismaServiceProvider($this->app);
        $provider->boot();

        // Debe renderizar sin InvalidArgumentException
        $toast = Blade::render('<x-p11-toast />');
        $this->assertStringContainsString('prisma:toast', $toast);

        $button = Blade::render('<x-p11-button color="primary">Click</x-p11-button>');
        $this->assertStringContainsString('Click', $button);

        // El prefijo canónico prisma-* también debe seguir disponible
        $prismaToast = Blade::render('<x-prisma-toast />');
        $this->assertStringContainsString('prisma:toast', $prismaToast);
    }

    public function test_custom_prefix_coexists_with_p11_and_prisma(): void
    {
        config(['prisma.prefix' => 'custom']);

        $provider = new PrismaServiceProvider($this->app);
        $provider->boot();

        $customButton = Blade::render('<x-custom-button color="success">Custom</x-custom-button>');
        $this->assertStringContainsString('Custom', $customButton);

        $p11Button = Blade::render('<x-p11-button color="success">P11</x-p11-button>');
        $this->assertStringContainsString('P11', $p11Button);

        $prismaButton = Blade::render('<x-prisma-button color="success">Prisma</x-prisma-button>');
        $this->assertStringContainsString('Prisma', $prismaButton);
    }
}
