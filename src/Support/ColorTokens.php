<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Support;

class ColorTokens
{
    /**
     * Devuelve la lista de las 8 intenciones cromáticas estándar.
     *
     * @return array<string>
     */
    public static function standardTokens(): array
    {
        return [
            'primary',
            'secondary',
            'success',
            'danger',
            'warning',
            'info',
            'light',
            'dark',
        ];
    }

    /**
     * Genera el bloque CSS con las variables semánticas para modo claro y oscuro.
     */
    public static function generateCssVariables(): string
    {
        /** @var array<string, array{light: array<string, string>, dark: array<string, string>}> $colors */
        $colors = config('prisma.colors', []);

        $lightCss = ":root {\n";
        $darkCss = ".dark {\n";

        foreach ($colors as $token => $modes) {
            $light = $modes['light'];
            $dark = $modes['dark'];

            // Modo Claro
            $lightCss .= "  --p11-{$token}: " . ($light['base'] ?? '0 0 0') . ";\n";
            $lightCss .= "  --p11-{$token}-fg: " . ($light['fg'] ?? '255 255 255') . ";\n";
            $lightCss .= "  --p11-{$token}-border: " . ($light['border'] ?? '0 0 0') . ";\n";
            $lightCss .= "  --p11-{$token}-ring: " . ($light['ring'] ?? '0 0 0') . ";\n";

            // Modo Oscuro
            $darkCss .= "  --p11-{$token}: " . ($dark['base'] ?? '255 255 255') . ";\n";
            $darkCss .= "  --p11-{$token}-fg: " . ($dark['fg'] ?? '0 0 0') . ";\n";
            $darkCss .= "  --p11-{$token}-border: " . ($dark['border'] ?? '255 255 255') . ";\n";
            $darkCss .= "  --p11-{$token}-ring: " . ($dark['ring'] ?? '255 255 255') . ";\n";
        }

        $lightCss .= "}\n";
        $darkCss .= "}\n";

        return $lightCss . "\n" . $darkCss;
    }

    /**
     * Devuelve el mapa de colores configurados para presets de Tailwind CSS v3.
     *
     * @return array<string, string>
     */
    public static function tailwindV3Colors(): array
    {
        $map = [];

        foreach (self::standardTokens() as $token) {
            $map[$token] = "rgb(var(--p11-{$token}) / <alpha-value>)";
            $map["{$token}-fg"] = "rgb(var(--p11-{$token}-fg) / <alpha-value>)";
            $map["{$token}-border"] = "rgb(var(--p11-{$token}-border) / <alpha-value>)";
            $map["{$token}-ring"] = "rgb(var(--p11-{$token}-ring) / <alpha-value>)";
        }

        return $map;
    }

    /**
     * Genera la directiva @theme para Tailwind CSS v4.
     */
    public static function tailwindV4ThemeCss(): string
    {
        $css = "@theme {\n";

        foreach (self::standardTokens() as $token) {
            $css .= "  --color-{$token}: rgb(var(--p11-{$token}));\n";
            $css .= "  --color-{$token}-fg: rgb(var(--p11-{$token}-fg));\n";
            $css .= "  --color-{$token}-border: rgb(var(--p11-{$token}-border));\n";
            $css .= "  --color-{$token}-ring: rgb(var(--p11-{$token}-ring));\n";
        }

        $css .= "}\n";

        return $css;
    }
}
