<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ServicioLineaOnce\Prisma11\Support\ColorTokens;

class WcagContrastAuditTest extends TestCase
{
    /**
     * Calcula la luminancia relativa según el estándar W3C WCAG 2.1.
     */
    protected function calculateRelativeLuminance(int $r, int $g, int $b): float
    {
        $channels = [$r, $g, $b];
        $transformed = [];

        foreach ($channels as $c) {
            $s = $c / 255;
            $transformed[] = ($s <= 0.04045)
                ? $s / 12.92
                : pow(($s + 0.055) / 1.055, 2.4);
        }

        return 0.2126 * $transformed[0] + 0.7152 * $transformed[1] + 0.0722 * $transformed[2];
    }

    /**
     * Calcula la relación de contraste (contrast ratio) entre dos colores RGB.
     */
    protected function calculateContrastRatio(string $rgb1, string $rgb2): float
    {
        $parts1 = array_map('intval', explode(' ', trim($rgb1)));
        $parts2 = array_map('intval', explode(' ', trim($rgb2)));

        $l1 = $this->calculateRelativeLuminance($parts1[0], $parts1[1], $parts1[2]);
        $l2 = $this->calculateRelativeLuminance($parts2[0], $parts2[1], $parts2[2]);

        $lighter = max($l1, $l2);
        $darker = min($l1, $l2);

        return ($lighter + 0.05) / ($darker + 0.05);
    }

    public function test_all_standard_tokens_meet_wcag_aa_contrast_ratio(): void
    {
        $config = require __DIR__ . '/../../config/prisma.php';
        /** @var array<string, array{light: array<string, string>, dark: array<string, string>}> $colors */
        $colors = $config['colors'];

        $tokens = ColorTokens::standardTokens();

        foreach ($tokens as $token) {
            $this->assertArrayHasKey($token, $colors, "El token {$token} debe existir en la configuración.");

            $light = $colors[$token]['light'];
            $dark = $colors[$token]['dark'];

            $lightRatio = $this->calculateContrastRatio($light['base'], $light['fg']);
            $this->assertGreaterThanOrEqual(
                4.5,
                $lightRatio,
                "El token [{$token}] en MODO CLARO debe tener un ratio de contraste >= 4.5:1 (obtenido: " . round($lightRatio, 2) . ":1)."
            );

            $darkRatio = $this->calculateContrastRatio($dark['base'], $dark['fg']);
            $this->assertGreaterThanOrEqual(
                4.5,
                $darkRatio,
                "El token [{$token}] en MODO OSCURO debe tener un ratio de contraste >= 4.5:1 (obtenido: " . round($darkRatio, 2) . ":1)."
            );
        }
    }
}
