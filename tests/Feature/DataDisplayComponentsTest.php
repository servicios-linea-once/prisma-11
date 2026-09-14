<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class DataDisplayComponentsTest extends TestCase
{
    public function test_card_renders_with_header_body_and_footer(): void
    {
        $rendered = Blade::render('
            <x-prisma-card title="Detalles de Facturación" description="Gestiona tus métodos de pago">
                <p>Contenido del cuerpo de la tarjeta</p>
                <x-slot:footer>
                    <button>Guardar Cambios</button>
                </x-slot:footer>
            </x-prisma-card>
        ');

        $this->assertStringContainsString('Detalles de Facturación', $rendered);
        $this->assertStringContainsString('Gestiona tus métodos de pago', $rendered);
        $this->assertStringContainsString('Contenido del cuerpo de la tarjeta', $rendered);
        $this->assertStringContainsString('Guardar Cambios', $rendered);
        $this->assertStringContainsString('bg-p11-surface', $rendered);
    }

    public function test_stat_renders_label_value_and_trend(): void
    {
        $rendered = Blade::render('
            <x-prisma-stat
                label="Ingresos Mensuales"
                value="$12,450.00"
                change="+14.2%"
                description="Comparado con el mes anterior"
            />
        ');

        $this->assertStringContainsString('Ingresos Mensuales', $rendered);
        $this->assertStringContainsString('$12,450.00', $rendered);
        $this->assertStringContainsString('+14.2%', $rendered);
        $this->assertStringContainsString('text-p11-success', $rendered);
        $this->assertStringContainsString('Comparado con el mes anterior', $rendered);
    }

    public function test_skeleton_renders_single_and_multi_line(): void
    {
        $single = Blade::render('<x-prisma-skeleton />');
        $this->assertStringContainsString('role="status"', $single);
        $this->assertStringContainsString('animate-pulse', $single);

        $multi = Blade::render('<x-prisma-skeleton lines="3" />');
        $this->assertStringContainsString('space-y-2.5', $multi);

        $circle = Blade::render('<x-prisma-skeleton variant="circular" />');
        $this->assertStringContainsString('rounded-full', $circle);
    }

    public function test_empty_state_renders_default_or_custom_content(): void
    {
        app()->setLocale('es');

        $rendered = Blade::render('
            <x-prisma-empty-state
                title="No hay clientes"
                description="Crea tu primer cliente para comenzar a facturar."
                action="Crear Cliente"
                action-url="/clientes/nuevo"
            />
        ');

        $this->assertStringContainsString('No hay clientes', $rendered);
        $this->assertStringContainsString('Crea tu primer cliente para comenzar a facturar.', $rendered);
        $this->assertStringContainsString('Crear Cliente', $rendered);
        $this->assertStringContainsString('/clientes/nuevo', $rendered);
    }

    public function test_table_renders_semantic_table_and_slots(): void
    {
        $rendered = Blade::render('
            <x-prisma-table :striped="true">
                <x-slot:head>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                </x-slot:head>
                <tr>
                    <td>1</td>
                    <td>Proyecto Alfa</td>
                    <td>Activo</td>
                </tr>
                <x-slot:footer>
                    <span>Total: 1 registro</span>
                </x-slot:footer>
            </x-prisma-table>
        ');

        $this->assertStringContainsString('role="table"', $rendered);
        $this->assertStringContainsString('ID</th>', $rendered);
        $this->assertStringContainsString('Proyecto Alfa', $rendered);
        $this->assertStringContainsString('Total: 1 registro', $rendered);
    }

    public function test_p11_alias_works_for_data_display(): void
    {
        $rendered = Blade::render('<x-p11-card title="Alias Test">Contenido</x-p11-card>');
        $this->assertStringContainsString('Alias Test', $rendered);
        $this->assertStringContainsString('Contenido', $rendered);
    }
}
