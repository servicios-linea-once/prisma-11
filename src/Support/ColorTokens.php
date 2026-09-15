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
     * Devuelve la configuración de los 5 temas oficiales de Prisma 11.
     *
     * @return array<string, array{name: string, primary: string, primary-fg: string, primary-border: string, primary-ring: string, theme-bg: string, theme-surface: string, theme-text: string}>
     */
    public static function themes(): array
    {
        return [
            'default' => [
                'name' => 'Default',
                'primary' => '22 163 74',
                'primary-fg' => '255 255 255',
                'primary-border' => '21 128 61',
                'primary-ring' => '34 197 94',
                'theme-bg' => '249 250 251',
                'theme-surface' => '255 255 255',
                'theme-text' => '17 24 39',
            ],
            'retro' => [
                'name' => 'Retro',
                'primary' => '239 153 149',
                'primary-fg' => '40 36 37',
                'primary-border' => '220 130 125',
                'primary-ring' => '245 175 170',
                'theme-bg' => '236 227 202',
                'theme-surface' => '228 217 185',
                'theme-text' => '40 36 37',
            ],
            'cyberpunk' => [
                'name' => 'Cyberpunk',
                'primary' => '255 117 152',
                'primary-fg' => '0 0 0',
                'primary-border' => '0 0 0',
                'primary-ring' => '0 240 255',
                'theme-bg' => '255 238 0',
                'theme-surface' => '245 225 0',
                'theme-text' => '0 0 0',
            ],
            'valentine' => [
                'name' => 'Valentine',
                'primary' => '233 109 123',
                'primary-fg' => '255 255 255',
                'primary-border' => '215 90 105',
                'primary-ring' => '245 140 155',
                'theme-bg' => '240 214 232',
                'theme-surface' => '248 230 242',
                'theme-text' => '99 43 78',
            ],
            'aqua' => [
                'name' => 'Aqua',
                'primary' => '0 215 192',
                'primary-fg' => '9 44 62',
                'primary-border' => '0 185 165',
                'primary-ring' => '50 235 215',
                'theme-bg' => '9 44 62',
                'theme-surface' => '16 60 82',
                'theme-text' => '240 250 255',
            ],
        ];
    }

    /**
     * Genera el bloque CSS con las variables semánticas para modo claro, oscuro y los 5 temas oficiales.
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

        // Bloques CSS para los 5 temas
        $themesCss = "";
        foreach (self::themes() as $key => $values) {
            $selector = $key === 'default'
                ? ":root, [data-theme=\"{$key}\"]"
                : "[data-theme=\"{$key}\"]";

            $themesCss .= "{$selector} {\n";
            $themesCss .= "  --p11-primary: {$values['primary']};\n";
            $themesCss .= "  --p11-primary-fg: {$values['primary-fg']};\n";
            $themesCss .= "  --p11-primary-border: {$values['primary-border']};\n";
            $themesCss .= "  --p11-primary-ring: {$values['primary-ring']};\n";
            $themesCss .= "  --p11-theme-bg: {$values['theme-bg']};\n";
            $themesCss .= "  --p11-theme-surface: {$values['theme-surface']};\n";
            $themesCss .= "  --p11-theme-text: {$values['theme-text']};\n";
            $themesCss .= "}\n\n";
        }

        // Utilidades de apoyo a temas
        $utilsCss = <<<CSS
.bg-primary { background-color: rgb(var(--p11-primary)) !important; }
.text-primary { color: rgb(var(--p11-primary)) !important; }
.text-primary-fg { color: rgb(var(--p11-primary-fg)) !important; }
.border-primary-border { border-color: rgb(var(--p11-primary-border)) !important; }
.ring-primary-ring { --tw-ring-color: rgb(var(--p11-primary-ring)) !important; }
[data-theme] {
  color: rgb(var(--p11-theme-text, 17 24 39));
}
CSS;

        return $lightCss . "\n" . $darkCss . "\n" . $themesCss . "\n" . $utilsCss;
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
