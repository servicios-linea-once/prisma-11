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
     * Devuelve el contenido del script de Alpine Store.
     */
    public static function storeScript(): string
    {
        $filePath = self::basePath('resources/js/prisma-store.js');
        if (file_exists($filePath)) {
            return (string) file_get_contents($filePath);
        }
        return '';
    }
}
