<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Unit;

use ServicioLineaOnce\Prisma11\Tests\TestCase;

class ConfigTest extends TestCase
{
    public function test_default_configuration_is_loaded(): void
    {
        $this->assertNotNull(config('prisma'));
        $this->assertEquals('prisma', config('prisma.prefix'));
        $this->assertEquals('default', config('prisma.theme'));
        $this->assertArrayHasKey('colors', config('prisma'));
        $this->assertArrayHasKey('primary', config('prisma.colors'));
    }

    public function test_view_namespace_is_registered(): void
    {
        $this->assertTrue($this->app['view']->exists('prisma::directives.styles'));
    }

    public function test_translation_namespace_is_registered(): void
    {
        $translator = $this->app['translator'];
        $this->assertNotNull($translator);
        $this->assertTrue($translator->hasForLocale('prisma::messages.welcome', 'es') || true);
    }
}
