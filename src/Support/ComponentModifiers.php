<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Support;

use Illuminate\View\ComponentAttributeBag;

class ComponentModifiers
{
    /**
     * Catálogo estándar de colores soportados como modificadores booleanos.
     *
     * @var list<string>
     */
    public const COLORS = [
        'primary',
        'secondary',
        'success',
        'danger',
        'warning',
        'info',
        'light',
        'dark',
        'alternative',
        'purple',
        'green',
        'red',
        'yellow',
        'blue',
    ];

    /**
     * Catálogo estándar de tamaños soportados como modificadores booleanos.
     *
     * @var list<string>
     */
    public const SIZES = [
        'xs',
        'sm',
        'md',
        'lg',
        'xl',
    ];

    /**
     * Catálogo estándar de variantes y formas soportadas como modificadores booleanos.
     *
     * @var list<string>
     */
    public const VARIANTS = [
        'solid',
        'outline',
        'pill',
        'ghost',
        'link',
        'soft',
        'gradient',
    ];

    /**
     * Resuelve los modificadores booleanos de un saco de atributos de Blade.
     *
     * @param ?ComponentAttributeBag $attributes
     * @param array{
     *     color?: ?string,
     *     size?: ?string,
     *     variant?: ?string,
     *     pill?: ?bool,
     *     outline?: ?bool,
     *     defaultColor?: string,
     *     defaultSize?: string,
     *     defaultVariant?: string
     * } $context
     * @return array{
     *     color: string,
     *     size: string,
     *     variant: string,
     *     pill: bool,
     *     outline: bool,
     *     attributes: ComponentAttributeBag
     * }
     */
    public static function resolve(?ComponentAttributeBag $attributes = null, array $context = []): array
    {
        $attributes = $attributes ?? new ComponentAttributeBag();
        $keysToExclude = [];

        // 1. Color
        $resolvedColor = $context['color'] ?? null;
        if ($resolvedColor === null || $resolvedColor === '') {
            foreach (self::COLORS as $colorKey) {
                if ($attributes->has($colorKey)) {
                    $resolvedColor = $colorKey;
                    $keysToExclude[] = $colorKey;
                    break;
                }
            }
        }
        $resolvedColor = $resolvedColor ?: ($context['defaultColor'] ?? 'primary');

        // 2. Tamaño (Size)
        $resolvedSize = $context['size'] ?? null;
        if ($resolvedSize === null || $resolvedSize === '') {
            foreach (self::SIZES as $sizeKey) {
                if ($attributes->has($sizeKey)) {
                    $resolvedSize = $sizeKey;
                    $keysToExclude[] = $sizeKey;
                    break;
                }
            }
        }
        $resolvedSize = $resolvedSize ?: ($context['defaultSize'] ?? 'md');

        // 3. Variante
        $resolvedVariant = $context['variant'] ?? null;
        if ($resolvedVariant === null || $resolvedVariant === '') {
            foreach (self::VARIANTS as $variantKey) {
                if ($attributes->has($variantKey)) {
                    $resolvedVariant = $variantKey;
                    $keysToExclude[] = $variantKey;
                    break;
                }
            }
        }
        $resolvedVariant = $resolvedVariant ?: ($context['defaultVariant'] ?? 'solid');

        // 4. Modificadores de forma adicionales (pill, outline)
        $isPill = $context['pill'] ?? false;
        if ($attributes->has('pill')) {
            $isPill = true;
            $keysToExclude[] = 'pill';
        }

        $isOutline = $context['outline'] ?? false;
        if ($attributes->has('outline')) {
            $isOutline = true;
            $keysToExclude[] = 'outline';
        }

        // Devolver atributos limpios sin las etiquetas modificadoras booleanas
        $cleanAttributes = empty($keysToExclude)
            ? $attributes
            : $attributes->except($keysToExclude);

        return [
            'color' => $resolvedColor,
            'size' => $resolvedSize,
            'variant' => $resolvedVariant,
            'pill' => $isPill,
            'outline' => $isOutline,
            'attributes' => $cleanAttributes,
        ];
    }
}
