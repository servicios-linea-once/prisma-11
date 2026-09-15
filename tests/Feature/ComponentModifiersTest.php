<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class ComponentModifiersTest extends TestCase
{
    public function test_button_renders_with_boolean_modifiers(): void
    {
        $rendered = Blade::render('<x-p11-button success sm solid>Procesando</x-p11-button>');

        $this->assertStringContainsString('bg-green-600', $rendered);
        $this->assertStringContainsString('text-sm px-3 py-2', $rendered);
        $this->assertStringContainsString('Procesando', $rendered);

        // Asegurar que no se filtran atributos booleanos al HTML
        $this->assertStringNotContainsString('success=""', $rendered);
        $this->assertStringNotContainsString('sm=""', $rendered);
        $this->assertStringNotContainsString('solid=""', $rendered);
    }

    public function test_button_renders_with_danger_outline_modifiers(): void
    {
        $rendered = Blade::render('<x-p11-button danger sm outline>Eliminar</x-p11-button>');

        $this->assertStringContainsString('border-danger', $rendered);
        $this->assertStringContainsString('text-danger', $rendered);
        $this->assertStringContainsString('text-sm px-3 py-2', $rendered);
        $this->assertStringContainsString('Eliminar', $rendered);
    }

    public function test_button_renders_with_pill_modifier(): void
    {
        $rendered = Blade::render('<x-p11-button info sm pill>Info</x-p11-button>');

        $this->assertStringContainsString('bg-blue-600', $rendered);
        $this->assertStringContainsString('rounded-full', $rendered);
        $this->assertStringContainsString('Info', $rendered);
    }

    public function test_button_defaults_cleanly_without_color_primary_attribute(): void
    {
        $rendered = Blade::render('<x-p11-button>Guardar</x-p11-button>');

        $this->assertStringContainsString('bg-primary', $rendered);
        $this->assertStringContainsString('Guardar', $rendered);
        $this->assertStringNotContainsString('color="primary"', $rendered);
    }

    public function test_button_backwards_compatible_with_explicit_color_attribute(): void
    {
        $rendered = Blade::render('<x-p11-button color="success" size="sm" variant="solid">OK</x-p11-button>');

        $this->assertStringContainsString('bg-green-600', $rendered);
        $this->assertStringContainsString('text-sm px-3 py-2', $rendered);
        $this->assertStringContainsString('OK', $rendered);
    }

    public function test_badge_renders_with_modifiers(): void
    {
        $rendered = Blade::render('<x-p11-badge success sm pill>Activo</x-p11-badge>');

        $this->assertStringContainsString('bg-success', $rendered);
        $this->assertStringContainsString('text-success-fg', $rendered);
        $this->assertStringContainsString('rounded-full', $rendered);
        $this->assertStringContainsString('Activo', $rendered);
    }

    public function test_alert_renders_with_modifiers(): void
    {
        $rendered = Blade::render('<x-p11-alert success dismissible>Operación OK</x-p11-alert>');

        $this->assertStringContainsString('bg-green-50', $rendered);
        $this->assertStringContainsString('check-circle', $rendered);
        $this->assertStringContainsString('Operación OK', $rendered);
    }

    public function test_indicator_renders_with_modifiers(): void
    {
        $rendered = Blade::render('<x-p11-indicator success ping sm />');

        $this->assertStringContainsString('bg-green-500', $rendered);
        $this->assertStringContainsString('animate-ping', $rendered);
        $this->assertStringContainsString('w-2.5 h-2.5', $rendered);
    }

    public function test_progress_renders_with_modifiers(): void
    {
        $rendered = Blade::render('<x-p11-progress success sm :value="80" />');

        $this->assertStringContainsString('bg-green-600', $rendered);
        $this->assertStringContainsString('h-1.5', $rendered);
        $this->assertStringContainsString('width: 80%', $rendered);
    }
}
