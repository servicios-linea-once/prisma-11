<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;

class Spinner extends BaseComponent
{
    public function __construct(
        public string $size = 'md',
        public string $color = 'primary',
    ) {}

    public function sizeClasses(): string
    {
        return match ($this->size) {
            'xs' => 'w-3 h-3',
            'sm' => 'w-4 h-4',
            'lg' => 'w-8 h-8',
            'xl' => 'w-12 h-12',
            default => 'w-5 h-5', // md
        };
    }

    public function colorClasses(): string
    {
        if ($this->color === 'current') {
            return 'text-current';
        }
        return "text-{$this->color}";
    }

    public function classes(): string
    {
        return $this->mergeClasses(
            'animate-spin shrink-0',
            $this->sizeClasses(),
            $this->colorClasses()
        );
    }

    public function render(): View
    {
        return view('prisma::components.spinner', [
            'classes' => $this->classes(),
        ]);
    }
}
