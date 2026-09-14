<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class FeedbackComponentsTest extends TestCase
{
    public function test_alert_renders_with_semantic_color_and_role(): void
    {
        $rendered = Blade::render('<x-prisma-alert color="warning" title="Atención">El servicio entrará en mantenimiento pronto.</x-prisma-alert>');

        $this->assertStringContainsString('role="alert"', $rendered);
        $this->assertStringContainsString('Atención', $rendered);
        $this->assertStringContainsString('El servicio entrará en mantenimiento pronto.', $rendered);
        $this->assertStringContainsString('border-warning', $rendered);
    }

    public function test_alert_renders_dismiss_button_when_dismissible(): void
    {
        $rendered = Blade::render('<x-prisma-alert color="info" dismissible>Mensaje informativo</x-prisma-alert>');

        $this->assertStringContainsString('x-data="{ show: true }"', $rendered);
        $this->assertStringContainsString('Mensaje informativo', $rendered);
        $this->assertStringContainsString('x-on:click="show = false"', $rendered);
    }

    public function test_toast_container_renders_with_alpine_store_listener(): void
    {
        $rendered = Blade::render('<x-prisma-toast position="top-end" />');

        $this->assertStringContainsString('prisma:toast', $rendered);
        $this->assertStringContainsString('role="status"', $rendered);
        $this->assertStringContainsString('aria-live="polite"', $rendered);
    }
}
