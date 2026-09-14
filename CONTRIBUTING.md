# Guía de Contribución — Prisma 11

¡Gracias por tu interés en contribuir a **Prisma 11**! Nos entusiasma recibir aportes que mantengan o eleven la calidad, accesibilidad y rendimiento de la biblioteca.

## Estándares de Código y Calidad

Para mantener la excelencia en la base de código, todas las contribuciones deben cumplir con las siguientes reglas:

1. **Tipado Estricto:**
   - Todos los archivos PHP deben incluir `declare(strict_types=1);` en la primera línea ejecutable.
   - Todo método o función debe contar con tipos de argumentos y tipos de retorno explícitos.
   - El código debe pasar **PHPStan en Nivel 9** sin supresiones `@phpstan-ignore` innecesarias.

2. **Cero Cadenas de Texto Estáticas:**
   - Todo texto legible para el usuario debe consumirse a través del sistema de traducciones (`__('prisma::messages.key')`).
   - Si introduces una nueva clave, debe ser agregada obligatoriamente tanto en `lang/es/messages.php` como en `lang/en/messages.php`.

3. **Accesibilidad (WCAG AA):**
   - Cualquier interacción con el teclado debe preservar el foco y soportar las convenciones WAI-ARIA (Escape para cerrar, Flechas para navegar, Tab para ciclar).
   - Los contrastes de color entre fondo y texto deben ser matemáticamente $\ge 4.5:1$ en modos claro y oscuro.

4. **Compatibilidad Dual de Tailwind:**
   - Todo componente debe ser compatible tanto con Tailwind CSS v3 (mediante el preset JS) como con Tailwind CSS v4 (mediante `@theme` y `@source`).
   - Utiliza exclusivamente utilidades lógicas de espaciado (`ms-`, `me-`, `ps-`, `pe-`, `start-`, `end-`) para garantizar soporte nativo de `dir="rtl"`.

## Flujo de Trabajo para el Desarrollo Local

1. Clona el repositorio y crea una rama descriptiva para tu funcionalidad o corrección:
   ```bash
   git checkout -b feature/nombre-de-tu-mejora
   ```

2. Instala las dependencias del proyecto:
   ```bash
   composer install
   ```

3. Ejecuta la suite de pruebas automatizadas:
   ```bash
   ./vendor/bin/pest
   ```

4. Ejecuta el análisis estático en nivel 9:
   ```bash
   ./vendor/bin/phpstan analyse
   ```

5. Audita el sistema con el comando de diagnóstico:
   ```bash
   php artisan prisma:doctor
   ```

## Envío de Pull Requests (PR)

- Asegúrate de que el 100% de los tests pasen en local antes de enviar tu PR.
- Incluye pruebas unitarias o de integración en `tests/` para cualquier nueva característica o corrección de error.
- Describe claramente en la descripción de tu PR el propósito del cambio y los componentes impactados.
