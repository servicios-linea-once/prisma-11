<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use ServicioLineaOnce\Prisma11\Support\ComponentModifiers;
use ServicioLineaOnce\Prisma11\Support\TailwindClassMerge;

abstract class BaseComponent extends Component
{
    /**
     * Fusiona clases CSS resolviendo conflictos de Tailwind.
     */
    public function mergeClasses(string ...$classes): string
    {
        return TailwindClassMerge::merge(...$classes);
    }

    /**
     * Resuelve los modificadores booleanos en los atributos del componente.
     *
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
    public function resolveModifiers(array $context = []): array
    {
        try {
            $attributes = $this->attributes;
        } catch (\Throwable) {
            $attributes = new ComponentAttributeBag();
        }
        $resolved = ComponentModifiers::resolve($attributes, $context);
        $this->attributes = $resolved['attributes'];

        return $resolved;
    }
}
