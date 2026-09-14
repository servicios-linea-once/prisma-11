Prisma 11 — Hoja de Ruta Arquitectónica y Técnica
Paquete: servicio-linea-once/prisma-11
Namespace PHP: ServicioLineaOnce\Prisma11\
Stack Base: Laravel (Blade) + Livewire + Alpine.js + Tailwind CSS (v3 / v4)
Autor: Servicio Línea Once
Licencia: MIT
1. Ficha Técnica de Identidad
| Parámetro | Especificación Oficial |
|---|---|
| Repositorio / Composer | servicio-linea-once/prisma-11 |
| Service Provider | ServicioLineaOnce\Prisma11\PrismaServiceProvider |
| Archivo de Configuración | config/prisma.php |
| Prefijo Blade | <x-prisma-...> (por defecto) o <x-p11-...> (compacto) |
| Namespace de Traducciones | __('prisma::mensajes.clave') |
| Prefijo de Variables CSS | --p11-* (--p11-primary, --p11-danger, etc.) |
| Herramientas de Consola | php artisan prisma:install, prisma:doctor, prisma:eject |
| Almacén Reactivo Alpine.js | Alpine.store('prisma') |
2. Sistema de Diseño: Tokens y Bipolaridad Cromática
2.1. Matriz de Tokens Semánticos Estándar
El sistema descarta los valores hexadecimales estáticos y adopta una paleta semántica estandarizada de ocho intenciones cromáticas, cada una con comportamiento polar garantizado para modo claro y oscuro:
| Token Semántico | Propósito en el Sistema | Comportamiento Modo Claro | Comportamiento Modo Oscuro |
|---|---|---|---|
| Primary | Acción principal, enlaces destacados, anillos de foco activo | Tono de marca con alto contraste sobre fondos claros | Tono de marca con luminosidad balanceada |
| Secondary | Acciones secundarias, elementos auxiliares, bordes neutros | Escala media de grises y neutros | Tonos neutros profundos con bordes sutiles |
| Success | Confirmaciones, estados completados, métricas positivas | Verde equilibrado con texto legible | Verde esmeralda desaturado accesible |
| Danger | Errores destructivos, cancelaciones, validación fallida | Rojo intenso de alerta | Rojo carmesí con reflectancia reducida |
| Warning | Advertencias preventivas, estados pendientes | Amarillo/ámbar cálido con texto oscuro | Ámbar dorado visible sobre fondos oscuros |
| Info | Mensajes orientativos, estados neutrales informativos | Azul cian luminoso | Cian suave con menor saturación |
| Light | Superficies elevadas, fondos de contenedor, tarjetas | Blanco puro o gris ultra-claro | Gris carbón profundo (superficie elevada) |
| Dark | Textos base, cabeceras de tabla, contrastes máximos | Negro grafito profundo | Blanco roto / gris perla para tipografía |
2.2. Anatomía de Sub-Tokens Derivados
Cada token resuelve automáticamente cuatro subtipos para asegurar consistencia y accesibilidad:
 * Base (--p11-[token]): Canal numérico puro (formato RGB / OKLCH) para habilitar modificadores de opacidad en Tailwind (bg-primary/50).
 * Foreground (--p11-[token]-fg): Color de texto de alto contraste que garantiza el cumplimiento de ratios WCAG AA sobre el fondo base.
 * Border (--p11-[token]-border): Variación perimetral para variantes de contorno (outline).
 * Ring (--p11-[token]-ring): Resaltado perimetral con opacidad predefinida para navegación por teclado.
3. Hoja de Ruta de Implementación (Roadmap)
[Etapa 0: Cimientos & Pipeline]
               │
               ▼
[Etapa 1: Motor Multi-Tema, i18n & CLI Didáctica]
               │
               ▼
[Etapa 2: Primitivas & Formularios Inteligentes]
               │
               ▼
[Etapa 3: Interacción Headless, A11y & Overlays]
               │
               ▼
[Etapa 4: Contenedores, Navegación & Datos]
               │
               ▼
[Etapa 5: Workbench, Diagnóstico & Docs Vivas]
               │
               ▼
[Etapa 6: Auditoría Final & Publicación v1.0.0]

Etapa 0: Esqueleto, Infraestructura y Pipeline de Estilos
 * Estructura PSR-4 del Repositorio:
   * Configuración del archivo composer.json con auto-descubrimiento en Laravel (extra.laravel.providers).
   * Creación del PrismaServiceProvider base (carga de vistas, rutas de assets compilados y merge de configuración).
   * Inclusión de dependencias de desarrollo esenciales: orchestra/testbench y livewire/livewire.
 * Compatibilidad Dual de Tailwind CSS:
   * Tailwind CSS v3: Exportación de preset.js con las utilidades del paquete y auto-registro de rutas vendor en la directiva content.
   * Tailwind CSS v4: Directivas @source para detección automática de vistas Blade sin archivo tailwind.config.js.
   * Motor PHP de fusión de clases Tailwind (class-merge) para resolver conflictos de especificidad en tiempo de ejecución sin dependencias de Node.js.
 * Pipeline de Variables CSS:
   * Creación de la directiva Blade @prismaStyles para inyectar dinámicamente las variables semánticas en el <head>.
Etapa 1: Motor Multi-Tema, i18n y Asistente CLI
 * Gestión de Temas y Modos en Cliente:
   * Registro de temas en config/prisma.php con definiciones duales (claro y oscuro).
   * Creación del almacén reactivo Alpine.store('prisma') para alternar modo (light, dark, system) y tema activo en menos de 16 ms sin recargar la página.
   * Micro-script anti-parpadeo (Anti-FOUC) inyectado en el <head> para sincronizar el estado visual desde localStorage o cookies antes del repintado del DOM.
 * Internacionalización (i18n) y Soporte RTL:
   * Cero textos fijos en vistas Blade o scripts de Alpine; delegación absoluta en diccionarios lang/vendor/prisma/[idioma].
   * Soporte inicial completo en Español (es) e Inglés (en).
   * Adopción estricta de utilidades lógicas de Tailwind (ms-, me-, ps-, pe-, start-, end-) para permitir inversión de diseño con dir="rtl".
 * Asistente CLI Guiado (php artisan prisma:install):
   * Asistente interactivo desarrollado con Laravel Prompts:
     * Selección guiada de la versión de Tailwind CSS (v3 con presets vs. v4 con directivas CSS modernas).
     * Selección del modo de entrega de scripts: Zero-build (inyección en runtime) vs. Módulo compilado (Vite / ES Modules).
     * Selección y previsualización en tiempo real del prefijo para componentes Blade (<x-prisma-...> vs. <x-p11-...>).
     * Resumen didáctico de archivos modificados, comandos sugeridos y enlaces a la documentación.
Etapa 2: Primitivas y Formularios Inteligentes
 * Primitivas Base (Átomos):
   * Button: Elemento polimórfico (<button> / <a>), integración nativa con estados wire:loading, ranuras para iconos y variantes cromáticas estándar.
   * Badge y Avatar: Escalas de xs a xl, indicadores de presencia y avatares con iniciales dinámicas.
   * Spinner e Icon: Indicadores de carga asíncrona y cargador SVG dinámico con caché.
 * Formularios con Auto-Detección de Contexto:
   * Componentes: Input, Textarea, Checkbox, Radio, Switch.
   * Inferencia automática de id, name, relaciones de accesibilidad for y aria-describedby a partir de wire:model o name.
   * Detección y consumo automático del ViewErrorBag de Laravel:
     * Activación de variantes visuales de error.
     * Inyección automática del mensaje de validación correspondiente.
     * Inserción de aria-invalid="true" para lectores de pantalla.
   * Ranuras estructurales para adornos: prefijos, sufijos y textos de ayuda (hint).
Etapa 3: Interacción Headless, Accesibilidad (A11y) y Overlays
 * Módulos Headless de Alpine.js:
   * Retención de foco (Focus Trapping) y restauración hacia el elemento activador al cerrar paneles.
   * Navegación por teclado con índice itinerante (Roving Tabindex) y búsqueda por tipeo rápido (Typeahead).
   * Motor de cálculo geométrico flotante con evasión de colisiones en los bordes de la ventana (flip automático vertical/horizontal).
 * Componentes de Superposición (Overlays):
   * Modal y Slide-over: Teleportación al final del <body>, soporte para múltiples capas superpuestas (stacking), y descarte accesible con tecla Escape o clic exterior.
   * Dropdown y Tooltip: Flotación contextual desacoplada de contenedores con overflow: hidden.
   * Combobox / Select: Selector con filtrado reactivo en tiempo real y soporte para búsquedas asíncronas conectadas a Livewire.
 * Feedback del Sistema:
   * Toast: Sistema de notificaciones reactivo gobernado por eventos, invocable tanto desde JavaScript como desde métodos del backend ($this->dispatch('prisma:toast', ...)).
   * Alert: Avisos semánticos con soporte para botones de cierre accesibles y roles ARIA apropiados.
Etapa 4: Contenedores, Navegación y Visualización de Datos
 * Componentes de Navegación Estructural:
   * Tabs: Pestañas accesibles por teclado, sincronizables opcionalmente con la URL (query string) o propiedades de Livewire.
   * Accordion: Paneles colapsables con preservación de estado durante la reconciliación del DOM (morphing).
   * Breadcrumb y Pagination: Mapeo contextual con traducciones integradas y compatibilidad de enlaces.
 * Visualización de Datos y Contenedores:
   * Card: Contenedor modular con ranuras semánticas (header, body, footer).
   * Stat: Tarjetas de métricas (KPI) con variaciones porcentuales e indicadores semánticos.
   * Table: Tabla interactiva con cabeceras ordenables, paginación integrada, ranuras de celda y estados vacíos (Empty state) integrados.
   * Skeleton: Indicadores de carga pulsantes para transiciones suaves de contenido diferido.
Etapa 5: Banco de Trabajo (Workbench), Diagnóstico CLI y Documentación
 * Herramientas de Diagnóstico y Desacoplamiento:
   * php artisan prisma:doctor: Diagnóstico automatizado que audita la configuración de Tailwind (v3/v4), versiones de Alpine/Livewire y colisiones de nombres.
   * php artisan prisma:eject: Asistente interactivo para expulsar componentes hacia la carpeta local del proyecto (app/View/Components/ y resources/views/components/), reescribiendo namespaces automáticamente.
 * Banco de Pruebas (Workbench Local):
   * Aplicación Laravel embebida con Orchestra Testbench para desarrollo en caliente sin instalaciones externas.
   * Laboratorio visual de matrices: cada componente desplegado en todos sus colores, escalas, variantes y modos (claro/oscuro) en paralelo.
   * Suite de pruebas automatizadas:
     * Pruebas unitarias del motor de resolución de clases y variantes PHP.
     * Pruebas de renderizado Blade y contratos ARIA.
     * Pruebas de integración con Livewire (ciclo de vida, wire:model, wire:loading y preservación de DOM).
 * Documentación Interactiva (Showcase):
   * Catálogo interactivo con editor de props en vivo (Playground), copia de código con un clic, selector global de tema/modo y visor LTR/RTL.
Etapa 6: Auditoría Final y Publicación v1.0.0
 * Control de Calidad:
   * Certificación de accesibilidad WCAG AA: contraste cromático verificado en los 8 canales semánticos sobre claro y oscuro, y operabilidad 100% por teclado.
   * Análisis estático de código PHP en nivel máximo de rigor tipado sin advertencias.
   * Pruebas de regresión visual para garantizar la consistencia entre versiones.
 * Publicación y Distribución:
   * Registro y publicación oficial en Packagist bajo servicio-linea-once/prisma-11.
   * Etiquetado semántico de versiones (SemVer) e integración continua mediante GitHub Actions.
4. Matriz de Dependencias Técnicas
| Hito | Nombre del Hito | Dependencia Requerida | Entregable Clave |
|---|---|---|---|
| H0 | Cimientos y Pipeline | Ninguna | Repositorio PSR-4, presets Tailwind v3/v4, variables --p11-* |
| H1 | Temas, i18n y CLI | H0 completado | Cambio de tema en 0ms, script anti-FOUC, comando prisma:install |
| H2 | Primitivas y Formularios | H0 y H1 | Botón, inputs y controles con auto-detección del error bag |
| H3 | Overlays e Interacción | H2 completado | Modales, Dropdowns, Combobox, sistema global de Toasts |
| H4 | Estructuras y Datos | H3 completado | Tablas dinámicas, Pestañas, Acordeones, Cards, Steppers |
| H5 | Workbench y Diagnóstico | H0 a H4 | prisma:doctor, prisma:eject, Testbench, Showcase interactivo |
| H6 | Auditoría y Release | H0 a H5 | Auditoría WCAG AA, PHPStan nivel máx., Packagist v1.0.0 |
