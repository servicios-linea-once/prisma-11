<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use ServicioLineaOnce\Prisma11\Tests\TestCase;

class TranslationsTest extends TestCase
{
    public function test_spanish_translations_contain_all_required_namespaces(): void
    {
        app()->setLocale('es');

        $this->assertEquals('Cargando...', __('prisma::messages.loading'));
        $this->assertEquals('Cerrar', __('prisma::messages.close'));
        $this->assertEquals('Confirmar', __('prisma::messages.confirm'));
        $this->assertEquals('Cancelar', __('prisma::messages.cancel'));
        $this->assertEquals('Sin datos disponibles', __('prisma::messages.empty_state.title'));
        $this->assertEquals('Anterior', __('prisma::messages.pagination.previous'));
        $this->assertEquals('Siguiente', __('prisma::messages.pagination.next'));
    }

    public function test_english_translations_contain_all_required_namespaces(): void
    {
        app()->setLocale('en');

        $this->assertEquals('Loading...', __('prisma::messages.loading'));
        $this->assertEquals('Close', __('prisma::messages.close'));
        $this->assertEquals('Confirm', __('prisma::messages.confirm'));
        $this->assertEquals('Cancel', __('prisma::messages.cancel'));
        $this->assertEquals('No data available', __('prisma::messages.empty_state.title'));
        $this->assertEquals('Previous', __('prisma::messages.pagination.previous'));
        $this->assertEquals('Next', __('prisma::messages.pagination.next'));
    }

    public function test_both_locales_have_matching_keys(): void
    {
        $es = require __DIR__ . '/../../lang/es/messages.php';
        $en = require __DIR__ . '/../../lang/en/messages.php';

        $this->assertSame(array_keys($es), array_keys($en));
        $this->assertSame(array_keys($es['pagination']), array_keys($en['pagination']));
        $this->assertSame(array_keys($es['empty_state']), array_keys($en['empty_state']));
        $this->assertSame(array_keys($es['forms']), array_keys($en['forms']));
        $this->assertSame(array_keys($es['modal']), array_keys($en['modal']));
        $this->assertSame(array_keys($es['toast']), array_keys($en['toast']));
        $this->assertSame(array_keys($es['alert']), array_keys($en['alert']));
        $this->assertSame(array_keys($es['table']), array_keys($en['table']));
    }
}
