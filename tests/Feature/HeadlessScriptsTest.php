<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class HeadlessScriptsTest extends TestCase
{
    public function test_prisma_scripts_loads_headless_modules(): void
    {
        $rendered = Blade::render('@prismaScripts');

        $this->assertStringContainsString('window.PrismaFloating', $rendered);
        $this->assertStringContainsString('window.PrismaFocusTrap', $rendered);
        $this->assertStringContainsString('window.PrismaRovingTabindex', $rendered);
    }
}
