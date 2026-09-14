<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class NavigationComponentsTest extends TestCase
{
    public function test_tabs_renders_with_tablist_and_aria_controls(): void
    {
        $rendered = Blade::render('
            <x-prisma-tabs active="perfil">
                <x-slot:tabs>
                    <x-prisma-tab name="perfil" label="Perfil de Usuario" />
                    <x-prisma-tab name="seguridad" label="Seguridad" />
                </x-slot:tabs>
                <div x-show="active === \'perfil\'">Contenido Perfil</div>
                <div x-show="active === \'seguridad\'">Contenido Seguridad</div>
            </x-prisma-tabs>
        ');

        $this->assertStringContainsString('role="tablist"', $rendered);
        $this->assertStringContainsString('Perfil de Usuario', $rendered);
        $this->assertStringContainsString('Seguridad', $rendered);
        $this->assertStringContainsString('role="tab"', $rendered);
    }

    public function test_accordion_renders_collapsible_items(): void
    {
        $rendered = Blade::render('
            <x-prisma-accordion>
                <x-prisma-accordion-item title="¿Qué es Prisma 11?">
                    Una biblioteca de componentes para Laravel.
                </x-prisma-accordion-item>
            </x-prisma-accordion>
        ');

        $this->assertStringContainsString('¿Qué es Prisma 11?', $rendered);
        $this->assertStringContainsString('Una biblioteca de componentes para Laravel.', $rendered);
        $this->assertStringContainsString('aria-expanded', $rendered);
    }

    public function test_breadcrumb_renders_semantic_nav_and_items(): void
    {
        $rendered = Blade::render('
            <x-prisma-breadcrumb :items="[
                [\'label\' => \'Inicio\', \'url\' => \'/\'],
                [\'label\' => \'Configuración\', \'url\' => \'/config\'],
                [\'label\' => \'Perfil\'],
            ]" />
        ');

        $this->assertStringContainsString('aria-label="Breadcrumb"', $rendered);
        $this->assertStringContainsString('Inicio', $rendered);
        $this->assertStringContainsString('Configuración', $rendered);
        $this->assertStringContainsString('aria-current="page"', $rendered);
    }

    public function test_pagination_renders_links_and_counters(): void
    {
        app()->setLocale('es');

        $rendered = Blade::render('
            <x-prisma-pagination :current-page="2" :total-pages="5" :total-items="50" :per-page="10" />
        ');

        $this->assertStringContainsString('role="navigation"', $rendered);
        $this->assertStringContainsString('Anterior', $rendered);
        $this->assertStringContainsString('Siguiente', $rendered);
        $this->assertStringContainsString('50', $rendered);
    }
}
