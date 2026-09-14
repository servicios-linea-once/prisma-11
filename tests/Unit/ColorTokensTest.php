<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Unit;

use ServicioLineaOnce\Prisma11\Tests\TestCase;
use ServicioLineaOnce\Prisma11\Support\ColorTokens;

class ColorTokensTest extends TestCase
{
    public function test_standard_tokens_contains_all_eight_semantic_intentions(): void
    {
        $tokens = ColorTokens::standardTokens();

        $expected = [
            'primary',
            'secondary',
            'success',
            'danger',
            'warning',
            'info',
            'light',
            'dark',
        ];

        $this->assertEquals($expected, $tokens);
    }

    public function test_css_variables_generation_includes_root_and_dark_scopes(): void
    {
        $css = ColorTokens::generateCssVariables();

        $this->assertStringContainsString(':root {', $css);
        $this->assertStringContainsString('.dark {', $css);

        foreach (ColorTokens::standardTokens() as $token) {
            $this->assertStringContainsString("--p11-{$token}:", $css);
            $this->assertStringContainsString("--p11-{$token}-fg:", $css);
            $this->assertStringContainsString("--p11-{$token}-border:", $css);
            $this->assertStringContainsString("--p11-{$token}-ring:", $css);
        }
    }

    public function test_tailwind_v3_preset_definition(): void
    {
        $colors = ColorTokens::tailwindV3Colors();

        foreach (ColorTokens::standardTokens() as $token) {
            $this->assertArrayHasKey($token, $colors);
            $this->assertArrayHasKey("{$token}-fg", $colors);
            $this->assertArrayHasKey("{$token}-border", $colors);
            $this->assertArrayHasKey("{$token}-ring", $colors);
            $this->assertEquals("rgb(var(--p11-{$token}) / <alpha-value>)", $colors[$token]);
        }
    }
}
