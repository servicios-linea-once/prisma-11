<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class IconifyIconTest extends TestCase
{
    public function test_icon_renders_iconify_icon_element_by_default(): void
    {
        $rendered = Blade::render('<x-p11-icon name="lucide:user" size="lg" color="primary" />');

        $this->assertStringContainsString('<iconify-icon', $rendered);
        $this->assertStringContainsString('icon="lucide:user"', $rendered);
        $this->assertStringContainsString('w-6 h-6', $rendered);
        $this->assertStringContainsString('text-primary', $rendered);
        $this->assertStringContainsString('aria-hidden="true"', $rendered);
    }

    public function test_icon_resolves_default_set_when_no_prefix_given(): void
    {
        config(['prisma.icons.default_set' => 'lucide']);

        $rendered = Blade::render('<x-prisma-icon name="check-circle" size="md" />');

        $this->assertStringContainsString('<iconify-icon', $rendered);
        $this->assertStringContainsString('icon="lucide:check-circle"', $rendered);
    }

    public function test_icon_supports_flip_and_rotate_attributes(): void
    {
        $rendered = Blade::render('<x-p11-icon name="tabler:arrow-right" flip="horizontal" rotate="90deg" />');

        $this->assertStringContainsString('flip="horizontal"', $rendered);
        $this->assertStringContainsString('rotate="90deg"', $rendered);
    }

    public function test_icon_renders_svg_when_driver_is_configured_as_svg(): void
    {
        config(['prisma.icons.driver' => 'svg']);

        $rendered = Blade::render('<x-p11-icon name="check" size="md" />');

        $this->assertStringContainsString('<svg', $rendered);
        $this->assertStringContainsString('xmlns="http://www.w3.org/2000/svg"', $rendered);
        $this->assertStringContainsString('<path d="M20 6 9 17l-5-5"/>', $rendered);
    }

    public function test_prisma_scripts_injects_iconify_web_component(): void
    {
        config(['prisma.icons.driver' => 'iconify']);

        $rendered = Blade::render('@prismaScripts');

        $this->assertStringContainsString('id="prisma-iconify"', $rendered);
        $this->assertStringContainsString('iconify-icon', $rendered);
    }
}
