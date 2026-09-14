<div align="center">

# 💎 Prisma 11

**Biblioteca de componentes UI de alta gama y sistema de diseño para el ecosistema Laravel**
*(Blade · Livewire v3 · Alpine.js · Tailwind CSS v3/v4)*

[![Latest Version](https://img.shields.io/badge/release-v1.0.0-blue.svg?style=flat-square)](https://packagist.org/packages/servicio-linea-once/prisma-11)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.2-777bb4.svg?style=flat-square)](https://php.net)
[![Laravel Support](https://img.shields.io/badge/laravel-10%20%7C%2011%20%7C%2012-ff2d20.svg?style=flat-square)](https://laravel.com)
[![PHPStan](https://img.shields.io/badge/phpstan-level%209-brightgreen.svg?style=flat-square)](https://phpstan.org)
[![Pest Tests](https://img.shields.io/badge/tests-63%20passed%20%2F%20309%20assertions-success.svg?style=flat-square)](https://pestphp.com)
[![WCAG AA](https://img.shields.io/badge/a11y-WCAG%20AA%20Compliant-blueviolet.svg?style=flat-square)](https://www.w3.org/WAI/WCAG21/quickref/)
[![License](https://img.shields.io/badge/license-MIT-green.svg?style=flat-square)](LICENSE)

</div>

---

## 🌟 ¿Qué es Prisma 11?

**Prisma 11** es una biblioteca integral de diseño y componentes UI pensada para desarrolladores Laravel que exigen la máxima sofisticación visual, rendimiento extremo y accesibilidad estricta.

Diseñada bajo los principios de **Zero-Overhead** y **Zero-Friction**, Prisma 11 combina la simplicidad de plantillas Blade con la reactividad de Alpine.js y Livewire v3, ofreciendo una experiencia idéntica a una SPA con la solidez del renderizado en el servidor.

---

## ⚡ Pilares de Arquitectura

1. **Resolución de Clases Tailwind en PHP (Class-Merge sin Node.js):**
   - Resuelve colisiones de especificidad (ej: `p-4` vs `p-6`, `bg-primary` vs `bg-danger`) en tiempo de ejecución de PHP con caché en memoria estática. Cero procesos Node secundarios requeridos.
2. **8 Tokens Semánticos Bipolares:**
   - Paletas cromáticas (`primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark`) con canales numéricos RGB puros (`base`, `fg`, `border`, `ring`) que permiten opacidades nativas (`bg-p11-primary/50`).
3. **Cambio de Modo Dinámico en < 16ms:**
   - `Alpine.store('prisma')` con persistencia en `localStorage` y cookies, coordinado con un micro-script síncrono anti-parpadeo (Anti-FOUC).
4. **Formularios con Inferencia de Contexto:**
   - Detección automática del `ViewErrorBag` de Laravel (`$errors->has($name)`), inyección de mensajes de error, asignación de `aria-invalid="true"` y atributos de accesibilidad automáticos.
5. **Módulos Headless de Interacción Accesible:**
   - Focus Trap, Roving Tabindex para listas y menús, y motor de auto-flip para posicionamiento flotante de modales, dropdowns y tooltips.
6. **Bilingüe (es/en) y Soporte Nativo RTL:**
   - Cero cadenas estáticas en vistas. Mapeo con utilidades lógicas de Tailwind (`ms-`, `me-`, `ps-`, `pe-`) para compatibilidad completa con `dir="rtl"`.
7. **Soporte Dual de Prefijos:**
   - Puedes invocar cualquier componente utilizando `<x-prisma-*>` o su alias corto `<x-p11-*>`.

---

## 🚀 Instalación Rápida

### 1. Requerir el paquete vía Composer

```bash
composer require servicio-linea-once/prisma-11
```

### 2. Ejecutar el Asistente Interactivo de Configuración

Prisma 11 incluye un instalador guiado desarrollado con **Laravel Prompts**:

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

    <!-- Inyecta los tokens semánticos CSS -->
    @prismaStyles
</head>
<body class="bg-p11-surface text-p11-surface-content antialiased">
    <!-- Contenedor global de notificaciones toast -->
    <x-prisma-toast />

    <!-- Tu contenido -->
    {{ $slot }}

    <!-- Inyecta el almacén reactivo de Alpine y el script anti-FOUC -->
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

## 🧩 Catálogo de Componentes

### 1. Primitivas Atómicas
```blade
<!-- Botones con variantes y soporte wire:loading -->
<x-prisma-button color="primary" variant="solid">Guardar</x-prisma-button>
<x-prisma-button color="danger" variant="outline" icon-leading="alert">Eliminar</x-prisma-button>
<x-p11-button color="success" size="sm" :loading="true">Procesando</x-p11-button>

<!-- Badges y Avatares -->
<x-prisma-badge color="success">Activo</x-prisma-badge>
<x-prisma-avatar name="Carlos Mendoza" status="online" size="md" />

<!-- Iconos y Spinners -->
<x-prisma-icon name="check" class="w-5 h-5 text-p11-success" />
<x-prisma-spinner size="md" color="primary" />
```

### 2. Controles de Formulario Inteligentes
```blade
<!-- Inferencia de errores y enlace con Livewire -->
<x-prisma-input
    name="email"
    type="email"
    label="Correo Electrónico"
    wire:model="email"
    placeholder="tu@empresa.com"
    hint="No compartiremos tu correo con terceros."
/>

<x-prisma-textarea name="comentarios" label="Comentarios" rows="3" />
<x-prisma-checkbox name="terminos" label="Acepto las condiciones de uso" />
<x-prisma-switch name="notificaciones" label="Activar notificaciones push" :checked="true" />
```

### 3. Superposiciones (Overlays) & Diálogos
```blade
<!-- Modal con Teleport al <body> y Focus Trap -->
<x-prisma-button @click="$dispatch('open-modal', 'modal-confirmacion')">
    Abrir Diálogo
</x-prisma-button>

<x-prisma-modal name="modal-confirmacion" title="¿Confirmar acción?">
    <p>Esta acción no se puede deshacer una vez procesada.</p>
    <x-slot:footer>
        <x-prisma-button @click="show = false" variant="ghost">Cancelar</x-prisma-button>
        <x-prisma-button color="danger">Confirmar Eliminación</x-prisma-button>
    </x-slot:footer>
</x-prisma-modal>

<!-- Panel Lateral Slide-Over (Drawer) -->
<x-prisma-slide-over name="panel-ajustes" title="Ajustes de Cuenta">
    <div class="space-y-4">...</div>
</x-prisma-slide-over>

<!-- Menú Dropdown Accesible -->
<x-prisma-dropdown>
    <x-slot:trigger>
        <button type="button" class="btn">Opciones</button>
    </x-slot:trigger>
    <a href="/perfil" class="block px-4 py-2 hover:bg-p11-muted/10">Perfil</a>
    <a href="/salir" class="block px-4 py-2 text-p11-danger">Cerrar Sesión</a>
</x-prisma-dropdown>
```

### 4. Sistema Reactivo de Feedback (Toasts & Alertas)
```blade
<!-- Disparar Toast desde Livewire -->
$this->dispatch('prisma:toast', type: 'success', title: 'Guardado', message: 'Datos actualizados con éxito.');

<!-- Disparar Toast desde JavaScript -->
window.dispatchEvent(new CustomEvent('prisma:toast', {
    detail: { type: 'info', title: 'Aviso', message: 'Nueva actualización disponible.' }
}));

<!-- Alertas Semánticas -->
<x-prisma-alert color="warning" title="Atención requerida" :dismissible="true">
    Tu suscripción vencerá en 3 días.
</x-prisma-alert>
```

### 5. Estructuras, Navegación y Visualización de Datos
```blade
<!-- Pestañas (Tabs) -->
<x-prisma-tabs active="general">
    <x-slot:tabs>
        <x-prisma-tab name="general" label="General" />
        <x-prisma-tab name="facturacion" label="Facturación" />
    </x-slot:tabs>
    <div x-show="active === 'general'">Panel General</div>
    <div x-show="active === 'facturacion'">Panel Facturación</div>
</x-prisma-tabs>

<!-- Tarjeta KPI / Stat -->
<x-prisma-stat
    label="Ingresos Mensuales"
    value="$14,250.00"
    change="+12.4%"
    trend="up"
    description="vs. mes anterior"
    color="success"
/>

<!-- Tabla de Datos con Paginación -->
<x-prisma-table :striped="true" :hover="true">
    <x-slot:head>
        <th>ID</th>
        <th>Nombre</th>
        <th>Estado</th>
    </x-slot:head>
    <tr>
        <td>1</td>
        <td>Servicio Prisma</td>
        <td><x-prisma-badge color="success">Operativo</x-prisma-badge></td>
    </tr>
    <x-slot:footer>
        <x-prisma-pagination :current-page="1" :total-pages="4" :total-items="40" :per-page="10" />
    </x-slot:footer>
</x-prisma-table>
```

---

## 🛠️ Herramientas CLI

### `php artisan prisma:doctor`
Audita en segundos la configuración del entorno, versiones compatibles de Tailwind, presencia de directivas Blade en plantillas y colisiones de nombres.

```bash
php artisan prisma:doctor
```

### `php artisan prisma:eject`
Permite desacoplar el paquete copiando cualquier componente o la biblioteca entera hacia tu aplicación (`resources/views/components/prisma/` y `app/View/Components/Prisma/`), reescribiendo automáticamente namespaces y referencias Blade.

```bash
# Expulsar un componente específico
php artisan prisma:eject button

# Expulsar toda la biblioteca
php artisan prisma:eject --all
```

---

## 🧪 Banco de Pruebas (Workbench) & Laboratorio Visual

Prisma 11 incorpora un laboratorio visual interactivo para desarrollo y previsualización local:

- **Matriz Cromática:** `http://localhost:8000/prisma/matrix`
- **Showcase Interactivo:** `http://localhost:8000/prisma/showcase`

---

## 🔬 Calidad & Pruebas Automatizadas

```bash
# Ejecutar suite de pruebas con Pest
./vendor/bin/pest

# Análisis estático riguroso (Nivel 9)
./vendor/bin/phpstan analyse
```

---

## 📄 Licencia

Prisma 11 es software de código abierto publicado bajo la [Licencia MIT](LICENSE). Desarrollado con esmero por **Servicio Línea Once**.
