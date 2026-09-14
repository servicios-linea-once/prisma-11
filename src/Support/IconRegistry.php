<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Support;

class IconRegistry
{
    /**
     * Catálogo integrado de SVGs esenciales del sistema (Lucide / Heroicons).
     *
     * @var array<string, string>
     */
    protected static array $icons = [
        'check' => '<path d="M20 6 9 17l-5-5"/>',
        'check-circle' => '<circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>',
        'x' => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
        'x-circle' => '<circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/>',
        'alert-circle' => '<circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/>',
        'alert-triangle' => '<path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12.01" y1="17" y2="17"/>',
        'info' => '<circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/>',
        'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
        'chevron-up' => '<path d="m18 15-6-6-6 6"/>',
        'chevron-left' => '<path d="m15 18-6-6 6-6"/>',
        'chevron-right' => '<path d="m9 18 6-6-6-6"/>',
        'search' => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
        'copy' => '<rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>',
        'moon' => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
        'sun' => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>',
        'user' => '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    ];

    /**
     * Devuelve el contenido SVG interno para un icono dado.
     */
    public static function get(string $name): ?string
    {
        return self::$icons[$name] ?? null;
    }

    /**
     * Registra o sobreescribe un icono en tiempo de ejecución.
     */
    public static function register(string $name, string $svgPathContent): void
    {
        self::$icons[$name] = $svgPathContent;
    }

    /**
     * Mapeo de tamaño de icono a clases Tailwind.
     */
    public static function sizeClasses(string $size): string
    {
        return match ($size) {
            'xs' => 'w-3.5 h-3.5',
            'sm' => 'w-4 h-4',
            'lg' => 'w-6 h-6',
            'xl' => 'w-8 h-8',
            default => 'w-5 h-5',
        };
    }
}
