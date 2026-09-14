<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Support;

class PrismaAssets
{
    /**
     * Obtiene la ruta base del paquete.
     */
    public static function basePath(string $path = ''): string
    {
        $base = dirname(__DIR__, 2);
        return $path !== '' ? $base . DIRECTORY_SEPARATOR . ltrim($path, '/\\') : $base;
    }

    /**
     * Devuelve el contenido combinado de scripts para Alpine.js y utilidades headless.
     */
    public static function storeScript(): string
    {
        $scripts = [
            self::basePath('resources/js/prisma-store.js'),
            self::basePath('resources/js/headless/floating-position.js'),
            self::basePath('resources/js/headless/focus-trap.js'),
            self::basePath('resources/js/headless/roving-tabindex.js'),
        ];

        $output = '';
        foreach ($scripts as $script) {
            if (file_exists($script)) {
                $output .= (string) file_get_contents($script) . "\n";
            }
        }

        return $output;
    }
}
