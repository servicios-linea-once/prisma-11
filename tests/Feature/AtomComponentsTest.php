<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class AtomComponentsTest extends TestCase
{
    public function test_button_renders_correctly_with_defaults(): void
    {
        $rendered = Blade::render('<x-prisma-button>Hacer clic</x-prisma-button>');

        $this->assertStringContainsString('<button', $rendered);
        $this->assertStringContainsString('Hacer clic', $rendered);
        $this->assertStringContainsString('bg-primary', $rendered);
        $this->assertStringContainsString('text-primary-fg', $rendered);
    }

    public function test_button_renders_as_anchor_when_href_is_provided(): void
    {
        $rendered = Blade::render('<x-prisma-button href="https://example.com" variant="outline" color="danger">Ir al sitio</x-prisma-button>');

        $this->assertStringContainsString('<a href="https://example.com"', $rendered);
        $this->assertStringContainsString('border-danger', $rendered);
        $this->assertStringContainsString('text-danger', $rendered);
    }

    public function test_badge_renders_with_semantic_variant(): void
    {
        $rendered = Blade::render('<x-prisma-badge color="success" size="sm">Activo</x-prisma-badge>');

        $this->assertStringContainsString('Activo', $rendered);
        $this->assertStringContainsString('bg-success', $rendered);
        $this->assertStringContainsString('text-success-fg', $rendered);
    }

    public function test_avatar_renders_initials_when_no_image_is_given(): void
    {
        $rendered = Blade::render('<x-prisma-avatar name="Jhon Doe" status="online" size="md" />');

        $this->assertStringContainsString('JD', $rendered);
        $this->assertStringContainsString('bg-success', $rendered); // indicador online
    }

    public function test_spinner_renders_svg_with_correct_classes(): void
    {
        $rendered = Blade::render('<x-prisma-spinner size="lg" color="primary" />');

        $this->assertStringContainsString('<svg', $rendered);
        $this->assertStringContainsString('animate-spin', $rendered);
        $this->assertStringContainsString('text-primary', $rendered);
    }

    public function test_icon_renders_registered_svg(): void
    {
        $rendered = Blade::render('<x-prisma-icon name="check" size="md" />');

        $this->assertStringContainsString('<svg', $rendered);
        $this->assertStringContainsString('aria-hidden="true"', $rendered);
    }

    public function test_compact_prefix_alias_works(): void
    {
        $rendered = Blade::render('<x-p11-button color="success">Guardar</x-p11-button>');

        $this->assertStringContainsString('<button', $rendered);
        $this->assertStringContainsString('Guardar', $rendered);
        $this->assertStringContainsString('bg-success', $rendered);
    }
}
