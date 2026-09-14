<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Support;

class TailwindClassMerge
{
    /**
     * Caché en memoria para combinaciones de clases resueltas.
     *
     * @var array<string, string>
     */
    protected static array $cache = [];

    /**
     * Fusiona clases de Tailwind resolviendo colisiones de especificidad.
     */
    public static function merge(string ...$classLists): string
    {
        $raw = implode(' ', array_filter($classLists, fn(string $val) => trim($val) !== ''));
        $raw = trim(preg_replace('/\s+/', ' ', $raw) ?? '');

        if ($raw === '') {
            return '';
        }

        if (isset(self::$cache[$raw])) {
            return self::$cache[$raw];
        }

        $classes = explode(' ', $raw);
        /** @var array<string, string> $resolved */
        $resolved = [];

        foreach ($classes as $class) {
            $class = trim($class);
            if ($class === '') {
                continue;
            }

            [$variants, $utility] = self::splitVariants($class);
            $group = self::resolveGroup($utility);

            $key = $variants !== '' ? "{$variants}:{$group}" : $group;
            $resolved[$key] = $class;
        }

        $result = implode(' ', array_values($resolved));
        self::$cache[$raw] = $result;

        return $result;
    }

    /**
     * Separa prefijos de variantes (ej: "hover:dark:focus:bg-red-500" -> ["hover:dark:focus", "bg-red-500"]).
     *
     * @return array{0: string, 1: string}
     */
    protected static function splitVariants(string $class): array
    {
        $lastColon = strrpos($class, ':');

        if ($lastColon === false) {
            return ['', $class];
        }

        return [
            substr($class, 0, $lastColon),
            substr($class, $lastColon + 1),
        ];
    }

    /**
     * Identifica el grupo de colisión de una utilidad base de Tailwind.
     */
    protected static function resolveGroup(string $utility): string
    {
        // Espaciado y Relleno (Padding)
        if (preg_match('/^p([xytbrlse])?-(.+)$/', $utility, $matches)) {
            $axis = $matches[1] ?: 'all';
            return "padding-{$axis}";
        }

        // Margen (Margin)
        if (preg_match('/^m([xytbrlse])?-(.+)$/', $utility, $matches)) {
            $axis = $matches[1] ?: 'all';
            return "margin-{$axis}";
        }

        // Fondo (Backgrounds)
        if (str_starts_with($utility, 'bg-')) {
            return 'bg-color';
        }

        // Tipografía: Tamaño de texto vs Color vs Alineación
        if (preg_match('/^text-(xs|sm|base|lg|xl|[2-9]xl)$/', $utility)) {
            return 'font-size';
        }
        if (preg_match('/^text-(left|center|right|justify|start|end)$/', $utility)) {
            return 'text-align';
        }
        if (str_starts_with($utility, 'text-')) {
            return 'text-color';
        }

        // Peso de fuente
        if (preg_match('/^font-(thin|extralight|light|normal|medium|semibold|bold|extrabold|black)$/', $utility)) {
            return 'font-weight';
        }

        // Radio de Borde (Rounded)
        if (preg_match('/^rounded(-[trblse]{1,2})?(-[a-z0-9]+)?$/', $utility, $matches)) {
            $corner = $matches[1] ?? 'all';
            return "rounded-{$corner}";
        }

        // Ancho y Color de Borde
        if (preg_match('/^border(-[trblse])?(-[0-9]+)?$/', $utility)) {
            return 'border-width';
        }
        if (str_starts_with($utility, 'border-')) {
            return 'border-color';
        }

        // Anillos de Enfoque (Ring)
        if (preg_match('/^ring(-[0-9]+)?$/', $utility)) {
            return 'ring-width';
        }
        if (str_starts_with($utility, 'ring-')) {
            return 'ring-color';
        }

        // Dimensiones
        if (str_starts_with($utility, 'w-')) return 'width';
        if (str_starts_with($utility, 'h-')) return 'height';
        if (str_starts_with($utility, 'min-w-')) return 'min-width';
        if (str_starts_with($utility, 'min-h-')) return 'min-height';
        if (str_starts_with($utility, 'max-w-')) return 'max-width';
        if (str_starts_with($utility, 'max-h-')) return 'max-height';

        // Flex & Grid
        if (preg_match('/^flex-(row|col|row-reverse|col-reverse)$/', $utility)) return 'flex-direction';
        if (preg_match('/^justify-(start|end|center|between|around|evenly|normal)$/', $utility)) return 'justify-content';
        if (preg_match('/^items-(start|end|center|baseline|stretch)$/', $utility)) return 'align-items';
        if (str_starts_with($utility, 'gap-')) return 'gap';

        // Otros
        if (str_starts_with($utility, 'opacity-')) return 'opacity';
        if (str_starts_with($utility, 'shadow')) return 'box-shadow';
        if (str_starts_with($utility, 'z-')) return 'z-index';
        if (str_starts_with($utility, 'cursor-')) return 'cursor';
        if (str_starts_with($utility, 'transition')) return 'transition';

        // Por defecto, si no colisiona con un grupo conocido, su propio nombre es la clave única
        return $utility;
    }
}
