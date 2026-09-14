<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class BladeDirectivesTest extends TestCase
{
    public function test_prisma_styles_directive_renders_css_variables(): void
    {
        $rendered = Blade::render('@prismaStyles');

        $this->assertStringContainsString('<style id="prisma-styles">', $rendered);
        $this->assertStringContainsString('--p11-primary:', $rendered);
        $this->assertStringContainsString('--p11-primary-fg:', $rendered);
        $this->assertStringContainsString('.dark {', $rendered);
    }

    public function test_prisma_scripts_directive_renders_anti_fouc_and_store(): void
    {
        $rendered = Blade::render('@prismaScripts');

        $this->assertStringContainsString('<script id="prisma-anti-fouc">', $rendered);
        $this->assertStringContainsString('p11-mode', $rendered);
        $this->assertStringContainsString('p11-theme', $rendered);
        $this->assertStringContainsString("Alpine.store('prisma'", $rendered);
    }
}
