# Changelog

Todos los cambios notables en este proyecto serán documentados en este archivo.

El formato está basado en [Keep a Changelog](https://keepachangelog.com/es-ES/1.0.0/),
y este proyecto se adhiere a [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-09-14

### Añadido
- **Arquitectura Base (PSR-4):**
  - Configuración inicial para Laravel 10.x, 11.x y 12.x sobre PHP 8.2, 8.3 y 8.4.
  - Proveedor de servicios `PrismaServiceProvider` con registro dinámico de vistas, comandos y directivas Blade.
  - Soporte de prefijo dual nativo: `<x-prisma-*>` y alias compacto `<x-p11-*>`.
- **Pipeline de Estilos & Tokens Semánticos:**
  - 8 intenciones cromáticas bipolares (`primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark`) con canales RGB independientes (`base`, `fg`, `border`, `ring`).
  - Resolución matemática de contraste con ratio $\ge 4.5:1$ en modos claro y oscuro conforme a WCAG AA.
  - Preset para Tailwind CSS v3 (`resources/css/preset.js`) y directiva `@theme` / `@source` para Tailwind CSS v4 (`resources/css/prisma.css`).
  - Motor de fusión de clases de Tailwind en PHP en tiempo de ejecución sin dependencias Node.js (`TailwindClassMerge`).
  - Directiva Blade `@prismaStyles` para inyección de variables CSS semánticas.
- **Motor Multi-Tema e Interactividad:**
  - Almacén reactivo de estado `Alpine.store('prisma')` con persistencia en `localStorage` y cookies (`<16ms` de tiempo de cambio).
  - Micro-script anti-parpadeo (Anti-FOUC) inyectable vía directiva Blade `@prismaScripts`.
  - Diccionario bilingüe completo (`es` y `en`) con paridad del 100% de claves (`lang/`).
  - Utilidades de diseño con soporte lógico LTR y RTL sin requerir CSS condicional.
- **Asistente y Diagnóstico CLI:**
  - Comando interactivo guiado `php artisan prisma:install` construido con Laravel Prompts.
  - Auditoría del entorno y compatibilidad mediante `php artisan prisma:doctor`.
  - Herramienta de desacoplamiento total de componentes a la aplicación anfitriona mediante `php artisan prisma:eject`.
- **Catálogo de Componentes (Atómicos, Formularios, Overlays, Datos):**
  - Primitivas: `Button`, `Badge`, `Avatar`, `Spinner`, `Icon` (con registro SVG optimizado).
  - Formularios Inteligentes: `Input`, `Textarea`, `Checkbox`, `Radio`, `SwitchToggle` con detección automática del `ViewErrorBag` de Laravel (`$errors`) y enlace `wire:model`.
  - Overlays Accesibles: `Modal` (Teleport), `Slide-over` (Drawer lateral), `Dropdown`, `Tooltip`, `Combobox` (búsqueda reactiva).
  - Módulos Headless en JS puro: Focus Trap, Roving Tabindex y motor geométrico auto-flip de Posicionamiento Flotante.
  - Feedback Reactivo: `Toast` (manejado por eventos Alpine y Livewire) y `Alert` semántica descartable.
  - Navegación: `Tabs`, `Accordion`, `Breadcrumb`, `Pagination`.
  - Visualización de Datos y Contenedores: `Card`, `Stat` (KPIs con tendencias), `Skeleton` (efecto pulso), `EmptyState`, `Table` semántica.
- **Workbench & Calidad:**
  - Banco de pruebas local en `workbench/` con matriz cromática (`/prisma/matrix`) y laboratorio interactivo (`/prisma/showcase`).
  - Análisis estático riguroso con PHPStan al Nivel 9 (0 errores).
  - Suite completa de pruebas automatizadas Pest (63 tests, 309 aserciones).
