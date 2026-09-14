<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class OverlayComponentsTest extends TestCase
{
    public function test_modal_renders_with_teleport_and_accessibility(): void
    {
        $rendered = Blade::render('<x-prisma-modal id="test-modal" title="Confirmar Acción">¿Deseas continuar?</x-prisma-modal>');

        $this->assertStringContainsString('template x-teleport="body"', $rendered);
        $this->assertStringContainsString('role="dialog"', $rendered);
        $this->assertStringContainsString('aria-modal="true"', $rendered);
        $this->assertStringContainsString('Confirmar Acción', $rendered);
        $this->assertStringContainsString('¿Deseas continuar?', $rendered);
    }

    public function test_slide_over_renders_with_drawer_panel(): void
    {
        $rendered = Blade::render('<x-prisma-slide-over id="test-drawer" title="Panel Lateral">Contenido del panel</x-prisma-slide-over>');

        $this->assertStringContainsString('template x-teleport="body"', $rendered);
        $this->assertStringContainsString('Panel Lateral', $rendered);
        $this->assertStringContainsString('Contenido del panel', $rendered);
    }

    public function test_dropdown_renders_trigger_and_menu(): void
    {
        $rendered = Blade::render('
            <x-prisma-dropdown>
                <x-slot:trigger><x-prisma-button>Opciones</x-prisma-button></x-slot:trigger>
                <a href="#perfil" role="menuitem">Mi Perfil</a>
            </x-prisma-dropdown>
        ');

        $this->assertStringContainsString('Opciones', $rendered);
        $this->assertStringContainsString('role="menu"', $rendered);
        $this->assertStringContainsString('Mi Perfil', $rendered);
    }

    public function test_tooltip_renders_accessible_anchor_and_bubble(): void
    {
        $rendered = Blade::render('
            <x-prisma-tooltip text="Copiar al portapapeles">
                <button type="button">Copiar</button>
            </x-prisma-tooltip>
        ');

        $this->assertStringContainsString('Copiar', $rendered);
        $this->assertStringContainsString('role="tooltip"', $rendered);
        $this->assertStringContainsString('Copiar al portapapeles', $rendered);
    }

    public function test_combobox_renders_search_input_and_options(): void
    {
        $rendered = Blade::render('
            <x-prisma-combobox name="country" label="País" :options="[\'mx\' => \'México\', \'es\' => \'España\']" />
        ');

        $this->assertStringContainsString('País', $rendered);
        $this->assertStringContainsString('role="combobox"', $rendered);
        $this->assertStringContainsString('México', $rendered);
        $this->assertStringContainsString('España', $rendered);
    }
}
