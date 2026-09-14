<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class FormControlsTest extends TestCase
{
    public function test_textarea_renders_with_label_and_rows(): void
    {
        $rendered = Blade::render('<x-prisma-textarea name="bio" label="Biografía" rows="6" maxlength="200" show-counter>Hola mundo</x-prisma-textarea>');

        $this->assertStringContainsString('<label for="bio"', $rendered);
        $this->assertStringContainsString('rows="6"', $rendered);
        $this->assertStringContainsString('maxlength="200"', $rendered);
        $this->assertStringContainsString('Hola mundo</textarea>', $rendered);
    }

    public function test_checkbox_renders_with_description_and_checked_state(): void
    {
        $rendered = Blade::render('<x-prisma-checkbox name="terms" label="Aceptar términos" description="Debes leer los términos y condiciones." checked />');

        $this->assertStringContainsString('type="checkbox"', $rendered);
        $this->assertStringContainsString('checked', $rendered);
        $this->assertStringContainsString('Aceptar términos', $rendered);
        $this->assertStringContainsString('Debes leer los términos y condiciones.', $rendered);
    }

    public function test_radio_renders_with_value_and_group_name(): void
    {
        $rendered = Blade::render('<x-prisma-radio name="plan" value="pro" label="Plan Profesional" checked />');

        $this->assertStringContainsString('type="radio"', $rendered);
        $this->assertStringContainsString('name="plan"', $rendered);
        $this->assertStringContainsString('value="pro"', $rendered);
        $this->assertStringContainsString('checked', $rendered);
        $this->assertStringContainsString('Plan Profesional', $rendered);
    }

    public function test_switch_renders_with_role_switch_and_alpine_bindings(): void
    {
        $rendered = Blade::render('<x-prisma-switch name="notifications" label="Activar notificaciones" checked />');

        $this->assertStringContainsString('role="switch"', $rendered);
        $this->assertStringContainsString(':aria-checked="on.toString()"', $rendered);
        $this->assertStringContainsString('x-data="{ on: true }"', $rendered);
        $this->assertStringContainsString('Activar notificaciones', $rendered);
    }
}
