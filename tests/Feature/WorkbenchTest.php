<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use ServicioLineaOnce\Prisma11\Tests\TestCase;

class WorkbenchTest extends TestCase
{
    public function test_workbench_matrix_route_renders_successfully(): void
    {
        $response = $this->get('/prisma/matrix');

        $response->assertOk();
        $response->assertSee('Prisma 11 — Matriz Cromática');
        $response->assertSee('Primitiva: Botones');
        $response->assertSee('Primitiva: Badges');
        $response->assertSee('Feedback: Alertas');
        $response->assertSee('Métricas & Stats', false);
    }

    public function test_workbench_showcase_route_renders_successfully(): void
    {
        $response = $this->get('/prisma/showcase');

        $response->assertOk();
        $response->assertSee('Prisma 11 — Laboratorio Interactivo');
        $response->assertSee('Overlays & Superposiciones', false);
        $response->assertSee('Formularios Inteligentes');
        $response->assertSee('Tabla de Datos y Paginación');
    }
}
