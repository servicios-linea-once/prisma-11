<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Support\ColorTokens;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class ThemeSystemTest extends TestCase
{
    public function test_config_contains_all_5_official_themes(): void
    {
        $themes = config('prisma.themes');

        $this->assertIsArray($themes);
        $this->assertArrayHasKey('default', $themes);
        $this->assertArrayHasKey('retro', $themes);
        $this->assertArrayHasKey('cyberpunk', $themes);
        $this->assertArrayHasKey('valentine', $themes);
        $this->assertArrayHasKey('aqua', $themes);
    }

    public function test_color_tokens_generates_css_variables_for_all_themes(): void
    {
        $css = ColorTokens::generateCssVariables();

        $this->assertStringContainsString('[data-theme="default"]', $css);
        $this->assertStringContainsString('[data-theme="retro"]', $css);
        $this->assertStringContainsString('[data-theme="cyberpunk"]', $css);
        $this->assertStringContainsString('[data-theme="valentine"]', $css);
        $this->assertStringContainsString('[data-theme="aqua"]', $css);
    }

    public function test_theme_selector_component_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-theme-selector />');

        $this->assertStringContainsString('Default', $rendered);
        $this->assertStringContainsString('Retro', $rendered);
        $this->assertStringContainsString('Cyberpunk', $rendered);
        $this->assertStringContainsString('Valentine', $rendered);
        $this->assertStringContainsString('Aqua', $rendered);
        $this->assertStringContainsString('setTheme', $rendered);
        $this->assertStringContainsString('bg-[#3f8306]', $rendered);
    }
}
