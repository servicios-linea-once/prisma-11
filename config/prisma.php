<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Prefijo de Componentes Blade
    |--------------------------------------------------------------------------
    | Define el prefijo usado para invocar los componentes en Blade.
    | Opciones recomendadas: 'prisma' (<x-prisma-button>) o 'p11' (<x-p11-button>).
    */
    'prefix' => env('PRISMA_PREFIX', 'p11'),

    /*
    |--------------------------------------------------------------------------
    | Tema Activo y Modo Predeterminado
    |--------------------------------------------------------------------------
    | El tema define el conjunto de paletas. El modo puede ser:
    | 'light' | 'dark' | 'system'
    */
    'theme' => env('PRISMA_THEME', 'default'),
    'mode' => env('PRISMA_MODE', 'system'),

    /*
    |--------------------------------------------------------------------------
    | Entrega de Assets
    |--------------------------------------------------------------------------
    | 'zero-build': inyecta scripts y estilos en tiempo de ejecución vía directivas.
    | 'compiled': utiliza módulos ES y compilación mediante Vite.
    */
    'delivery' => env('PRISMA_DELIVERY', 'zero-build'),

    /*
    |--------------------------------------------------------------------------
    | Iconos (Integración Iconify)
    |--------------------------------------------------------------------------
    | Prisma 11 utiliza Iconify para ofrecer más de 200,000 iconos vectoriales.
    | - driver: 'iconify' (Web Component <iconify-icon>) o 'svg' (SVG inline local).
    | - default_set: Prefijo del conjunto predeterminado (ej: 'lucide', 'heroicons', 'tabler').
    | - cdn: Script del Web Component de Iconify inyectado en @prismaScripts.
    */
    'icons' => [
        'driver' => env('PRISMA_ICON_DRIVER', 'iconify'),
        'default_set' => env('PRISMA_ICON_SET', 'lucide'),
        'cdn' => env('PRISMA_ICON_CDN', 'https://code.iconify.design/iconify-icon/2.3.0/iconify-icon.min.js'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Matriz de Tokens Semánticos Bipolares (Claro / Oscuro)
    |--------------------------------------------------------------------------
    | Cada token define canales RGB puros ('base', 'fg', 'border', 'ring')
    | para permitir opacidad nativa en Tailwind (ej: bg-primary/50).
    */
    'colors' => [
        'primary' => [
            'light' => [
                'base' => '3 105 161',       // Sky 700
                'fg' => '255 255 255',
                'border' => '2 132 199',     // Sky 600
                'ring' => '56 189 248',      // Sky 400
            ],
            'dark' => [
                'base' => '56 189 248',      // Sky 400
                'fg' => '15 23 42',          // Slate 900
                'border' => '14 165 233',    // Sky 500
                'ring' => '125 211 252',     // Sky 300
            ],
        ],

        'secondary' => [
            'light' => [
                'base' => '71 85 105',       // Slate 600
                'fg' => '255 255 255',
                'border' => '51 65 85',      // Slate 700
                'ring' => '148 163 184',     // Slate 400
            ],
            'dark' => [
                'base' => '148 163 184',     // Slate 400
                'fg' => '15 23 42',
                'border' => '100 116 139',
                'ring' => '203 213 225',
            ],
        ],

        'success' => [
            'light' => [
                'base' => '4 120 87',        // Emerald 700
                'fg' => '255 255 255',
                'border' => '5 150 105',     // Emerald 600
                'ring' => '52 211 153',      // Emerald 400
            ],
            'dark' => [
                'base' => '52 211 153',      // Emerald 400
                'fg' => '6 78 59',           // Emerald 900
                'border' => '16 185 129',
                'ring' => '110 231 183',
            ],
        ],

        'danger' => [
            'light' => [
                'base' => '220 38 38',       // Red 600
                'fg' => '255 255 255',
                'border' => '185 28 28',     // Red 700
                'ring' => '248 113 113',     // Red 400
            ],
            'dark' => [
                'base' => '248 113 113',     // Red 400
                'fg' => '69 10 10',          // Red 950
                'border' => '239 68 68',
                'ring' => '252 165 165',
            ],
        ],

        'warning' => [
            'light' => [
                'base' => '245 158 11',      // Amber 500
                'fg' => '69 26 3',           // Amber 950
                'border' => '217 119 6',     // Amber 600
                'ring' => '251 191 36',      // Amber 400
            ],
            'dark' => [
                'base' => '251 191 36',      // Amber 400
                'fg' => '69 26 3',           // Amber 950
                'border' => '245 158 11',
                'ring' => '253 230 138',
            ],
        ],

        'info' => [
            'light' => [
                'base' => '14 116 144',      // Cyan 700
                'fg' => '255 255 255',
                'border' => '8 145 178',     // Cyan 600
                'ring' => '34 211 238',      // Cyan 400
            ],
            'dark' => [
                'base' => '34 211 238',      // Cyan 400
                'fg' => '22 78 99',          // Cyan 900
                'border' => '6 182 212',
                'ring' => '103 232 249',
            ],
        ],

        'light' => [
            'light' => [
                'base' => '248 250 252',     // Slate 50
                'fg' => '15 23 42',          // Slate 900
                'border' => '226 232 240',   // Slate 200
                'ring' => '203 213 225',     // Slate 300
            ],
            'dark' => [
                'base' => '30 41 59',        // Slate 800
                'fg' => '248 250 252',       // Slate 50
                'border' => '51 65 85',      // Slate 700
                'ring' => '71 85 105',       // Slate 600
            ],
        ],

        'dark' => [
            'light' => [
                'base' => '15 23 42',        // Slate 900
                'fg' => '255 255 255',
                'border' => '30 41 59',      // Slate 800
                'ring' => '51 65 85',        // Slate 700
            ],
            'dark' => [
                'base' => '241 245 249',     // Slate 100
                'fg' => '15 23 42',          // Slate 900
                'border' => '203 213 225',   // Slate 300
                'ring' => '148 163 184',     // Slate 400
            ],
        ],
    ],
];
