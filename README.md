<div align="center">

# 💎 Prisma 11

**Biblioteca de componentes UI de alta gama y sistema de diseño para el ecosistema Laravel**  
*(Blade · Livewire v3 · Alpine.js · Tailwind CSS v3/v4 · Iconify)*

[![Latest Version](https://img.shields.io/badge/release-v1.0.3-blue.svg?style=flat-square)](https://packagist.org/packages/servicio-linea-once/prisma-11)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.2-777bb4.svg?style=flat-square)](https://php.net)
[![Laravel Support](https://img.shields.io/badge/laravel-10%20%7C%2011%20%7C%2012-ff2d20.svg?style=flat-square)](https://laravel.com)
[![PHPStan](https://img.shields.io/badge/phpstan-level%209-brightgreen.svg?style=flat-square)](https://phpstan.org)
[![Pest Tests](https://img.shields.io/badge/tests-120%20passed%20%2F%20472%20assertions-success.svg?style=flat-square)](https://pestphp.com)
[![WCAG AA](https://img.shields.io/badge/a11y-WCAG%20AA%20Compliant-blueviolet.svg?style=flat-square)](https://www.w3.org/WAI/WCAG21/quickref/)
[![License](https://img.shields.io/badge/license-MIT-green.svg?style=flat-square)](LICENSE)

</div>

---

## 🌟 ¿Qué es Prisma 11?

**Prisma 11** es una biblioteca integral de componentes UI y sistema de diseño para desarrolladores Laravel que exigen la máxima sofisticación visual, rendimiento extremo y accesibilidad estricta.

Diseñada bajo los principios de **Zero-Overhead** y **Zero-Boilerplate**, Prisma 11 combina la simplicidad de plantillas Blade con la reactividad de Alpine.js y Livewire v3, ofreciendo más de **66 componentes de alta calidad**, soporte para **modificadores booleanos directos**, **5 temas oficiales**, integración con **Iconify** (+200,000 iconos) y prefijo dinámico configurable.

---

## ⚡ Novedades y Pilares de Arquitectura

1. **Sintaxis de Modificadores Booleanos (Zero-Boilerplate):**
   - Escribe componentes de forma concisa y natural sin props verbosos como `color="primary"`.
   - Ejemplo: `<x-p11-button success sm solid>Procesando</x-p11-button>` o `<x-p11-badge danger pill>Crítico</x-p11-badge>`.
   - **Limpieza de atributos HTML:** Los modificadores son extraídos y eliminados del HTML final para garantizar marcado semántico impecable.
2. **Sistema Multi-Tema Oficial (5 Temas):**
   - Paletas temáticas integradas: **Default**, **Retro**, **Cyberpunk**, **Valentine** y **Aqua**.
   - Componente interactivo `<x-p11-theme-selector />` con persistencia en `localStorage` y cero parpadeo (Anti-FOUC).
3. **Ecosistema Iconify (+200,000 iconos):**
   - Soporte nativo para cualquier colección de iconos del mundo (Lucide, Heroicons, Material Design, FontAwesome, Tabler, etc.) mediante `<x-p11-icon name="lucide:check" />`.
4. **Prefijo Dinámico y Configurable:**
   - Configurable en `config/prisma.php` (`'prefix' => env('PRISMA_PREFIX', 'p11')`).
   - Soporte dual predeterminado para invocar componentes como `<x-p11-*>` o `<x-prisma-*>`.
5. **Resolución de Clases Tailwind en PHP (Class-Merge sin Node.js):**
   - Resuelve colisiones de especificidad (ej: `p-4` vs `p-6`, `bg-primary` vs `bg-danger`) en tiempo de ejecución de PHP con caché estática ultra-rápida.
6. **Formularios con Inferencia de Contexto:**
   - Detección automática de `ViewErrorBag` de Laravel (`$errors->has($name)`), inyección de mensajes de error y atributos `aria-invalid="true"`.
7. **Módulos Headless de Interacción Accesible:**
   - Focus Trap, Roving Tabindex para listas y menús, y motor de auto-flip para posicionamiento flotante de modales, dropdowns y tooltips.
8. **Bilingüe (es/en) y Soporte Nativo RTL:**
   - Cero cadenas fijas en vistas. Mapeo con utilidades lógicas de Tailwind (`ms-`, `me-`, `ps-`, `pe-`).

---

## 🚀 Instalación Rápida

### 1. Requerir el paquete vía Composer

```bash
composer require servicio-linea-once/prisma-11
```

### 2. Ejecutar el Asistente Interactivo de Configuración

```bash
php artisan prisma:install
```

El instalador detectará si tu aplicación usa **Tailwind CSS v3** o **v4**, te permitirá seleccionar el modo de entrega (*Zero-Build* vs *Compilado*) y publicará automáticamente `config/prisma.php`.

### 3. Agregar las Directivas Blade en tu Layout Principal

En tu plantilla base (ej. `resources/views/layouts/app.blade.php`):

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Inyecta los tokens semánticos CSS y temas -->
    @prismaStyles
</head>
<body class="bg-p11-surface text-p11-surface-content antialiased">
    <!-- Selector de tema interactivo -->
    <x-p11-theme-selector />

    <!-- Contenedor global de notificaciones toast -->
    <x-p11-toast />

    <!-- Tu contenido -->
    {{ $slot }}

    <!-- Inyecta el almacén reactivo de Alpine, iconos Iconify y script anti-FOUC -->
    @prismaScripts
</body>
</html>
```

---

## 🎨 Integración con Tailwind CSS

### Para Tailwind CSS v4 (Recomendado)
Agrega en tu archivo `resources/css/app.css`:

```css
@import "tailwindcss";
@import "../../vendor/servicio-linea-once/prisma-11/resources/css/prisma.css";
@source "../../vendor/servicio-linea-once/prisma-11/resources/views/**/*.blade.php";
```

### Para Tailwind CSS v3
Agrega el preset en tu `tailwind.config.js`:

```javascript
module.exports = {
  presets: [
    require('./vendor/servicio-linea-once/prisma-11/resources/css/preset.js')
  ],
  content: [
    './resources/views/**/*.blade.php',
    './vendor/servicio-linea-once/prisma-11/resources/views/**/*.blade.php',
  ],
  // ...
}
```

---

## 🌈 Sistema de 5 Temas Oficiales

Prisma 11 incorpora 5 temas prediseñados listos para producción:

| Tema | Descripción Visual | Identificador |
| :--- | :--- | :--- |
| **Default** | Indigo moderno, superficies limpias y equilibradas | `default` |
| **Retro** | Tonos cálidos tierra, beige suave y estética vintage | `retro` |
| **Cyberpunk** | Neón amarillo vibrante, cian y alto contraste | `cyberpunk` |
| **Valentine** | Rosa pastel, lavanda y toques florales suaves | `valentine` |
| **Aqua** | Azul profundo, cian oceánico y verde azulado | `aqua` |

### Uso del Selector de Tema
```blade
<x-p11-theme-selector />
```
El selector permite cambiar entre los temas en tiempo real, guardando automáticamente la preferencia en `localStorage` y sincronizándola en toda la aplicación.

---

## 🧩 Catálogo de Componentes y Sintaxis Concisa

### 1. Botones con Modificadores Booleanos
```blade
<!-- Modificadores directos de color, tamaño y variante -->
<x-p11-button primary>Guardar</x-p11-button>
<x-p11-button success sm solid>Procesando</x-p11-button>
<x-p11-button danger lg outline pill>Eliminar</x-p11-button>
<x-p11-button warning soft xs>Advertencia</x-p11-button>
<x-p11-button info ghost>Detalles</x-p11-button>

<!-- Soporte wire:loading y estado de carga -->
<x-p11-button primary :loading="true">Guardando...</x-p11-button>
```

### 2. Badges, Indicadores y Spinners
```blade
<!-- Badges con banderas booleanas -->
<x-p11-badge success sm pill>Activo</x-p11-badge>
<x-p11-badge danger outline>Error</x-p11-badge>
<x-p11-badge warning soft>Pendiente</x-p11-badge>

<!-- Indicadores de estado -->
<x-p11-indicator success pulse />
<x-p11-indicator danger size="lg" />

<!-- Spinners -->
<x-p11-spinner success sm />
<x-p11-spinner primary lg />
```

### 3. Iconos Universales con Iconify
```blade
<!-- Lucide Icons -->
<x-p11-icon name="lucide:check-circle" class="w-5 h-5 text-success" />

<!-- Heroicons -->
<x-p11-icon name="heroicons:home" class="w-6 h-6" />

<!-- Material Design Icons & Tabler -->
<x-p11-icon name="mdi:account" class="w-5 h-5" />
<x-p11-icon name="tabler:settings" class="w-5 h-5" />
```

### 4. Alertas Semánticas
```blade
<x-p11-alert success border icon="lucide:check-circle" :dismissible="true">
    ¡Operación completada con éxito!
</x-p11-alert>

<x-p11-alert warning border icon="lucide:alert-triangle">
    Tu suscripción vencerá en 3 días.
</x-p11-alert>

<x-p11-alert danger icon="lucide:shield-alert">
    Error crítico al procesar la solicitud.
</x-p11-alert>
```

### 5. Formularios Inteligentes
```blade
<!-- Inferencia de errores y enlace con Livewire -->
<x-p11-input
    name="email"
    type="email"
    label="Correo Electrónico"
    wire:model="email"
    placeholder="tu@empresa.com"
    hint="No compartiremos tu correo con terceros."
/>

<x-p11-textarea name="comentarios" label="Comentarios" rows="3" />
<x-p11-checkbox name="terminos" label="Acepto los términos y condiciones" success />
<x-p11-radio name="plan" label="Plan Profesional" value="pro" primary />
<x-p11-switch name="notificaciones" label="Activar notificaciones push" :checked="true" success />
<x-p11-range name="volumen" min="0" max="100" value="50" primary />
<x-p11-select name="pais" label="País" :options="['pe' => 'Perú', 'mx' => 'México', 'co' => 'Colombia']" />
```

### 6. Overlays y Diálogos
```blade
<!-- Modal con Teleport al <body> y Focus Trap -->
<x-p11-button primary @click="$dispatch('open-modal', 'modal-confirmacion')">
    Abrir Diálogo
</x-p11-button>

<x-p11-modal name="modal-confirmacion" title="¿Confirmar acción?">
    <p>Esta acción no se puede deshacer una vez procesada.</p>
    <x-slot:footer>
        <x-p11-button @click="show = false" ghost>Cancelar</x-p11-button>
        <x-p11-button danger solid>Confirmar</x-p11-button>
    </x-slot:footer>
</x-p11-modal>

<!-- Drawer / Slide-Over lateral -->
<x-p11-drawer name="panel-ajustes" title="Ajustes de Cuenta">
    <div class="space-y-4">...</div>
</x-p11-drawer>

<!-- Dropdown accesible -->
<x-p11-dropdown>
    <x-slot:trigger>
        <x-p11-button light outline sm>Opciones</x-p11-button>
    </x-slot:trigger>
    <a href="/perfil" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Mi Perfil</a>
    <a href="/salir" class="block px-4 py-2 text-danger hover:bg-red-50">Cerrar Sesión</a>
</x-p11-dropdown>
```

### 7. Componentes Avanzados de Datos y Visualización
Prisma 11 incluye componentes especializados para aplicaciones de alto nivel:
- **Datatable & Table:** Tablas responsivas con paginación, filtros y ordenación.
- **Chart:** Gráficos interactivos integrados.
- **WYSIWYG:** Editor de texto enriquecido listo para formularios.
- **Speed Dial:** Menú flotante de acciones rápidas.
- **Timeline & Stepper:** Líneas de tiempo de eventos y pasos de progreso guiados.
- **Carousel & Gallery:** Visualizadores multimedia y galerías fotográficas.
- **Device Mockup:** Maquetas de dispositivos (iPhone, MacBook, iPad, Android).
- **Clipboard:** Botones interactivos de copiado rápido con feedback visual.
- **QR Code:** Generador dinámico de códigos QR para enlaces o datos.

---

## 🛠️ Herramientas CLI

### `php artisan prisma:doctor`
Audita en segundos la configuración del entorno, versiones compatibles de Tailwind, presencia de directivas Blade en plantillas y colisiones de nombres:

```bash
php artisan prisma:doctor
```

### `php artisan prisma:eject`
Permite desacoplar el paquete copiando cualquier componente o la biblioteca entera hacia tu aplicación (`resources/views/components/prisma/` y `app/View/Components/Prisma/`), reescribiendo automáticamente namespaces y referencias Blade:

```bash
# Expulsar un componente específico
php artisan prisma:eject button

# Expulsar toda la biblioteca
php artisan prisma:eject --all
```

---

## 🧪 Banco de Pruebas (Workbench) & Laboratorio Visual

Prisma 11 incorpora un laboratorio visual interactivo para desarrollo y previsualización local:

- **Showcase Completo:** `http://localhost:8000/prisma/showcase`
- **Matriz Cromática & Temas:** `http://localhost:8000/prisma/matrix`

---

## 🔬 Calidad & Pruebas Automatizadas

El paquete cuenta con una cobertura exhaustiva con **Pest** y análisis estático en el nivel más estricto de **PHPStan (Nivel 9)**:

```bash
# Ejecutar suite de pruebas con Pest (120 tests, 472 aserciones)
vendor\bin\pest

# Análisis estático riguroso Nivel 9 (0 errores)
vendor\bin\phpstan analyse --memory-limit=2G
```

---

## 🏷️ Control de Versiones

Prisma 11 mantiene un versionado semántico secuencial estricto en la rama `v1.0.*`:

```bash
# Publicar el siguiente tag secuencial en origin
php bin/bump-tag.php
```

---

## 📄 Licencia

Prisma 11 es software de código abierto publicado bajo la [Licencia MIT](LICENSE). Desarrollado con esmero por **Servicio Línea Once**.
