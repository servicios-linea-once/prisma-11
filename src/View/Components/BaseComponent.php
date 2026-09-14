<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\View\Component;
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
}
