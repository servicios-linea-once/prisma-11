<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;
use ServicioLineaOnce\Prisma11\Support\IconRegistry;

class Icon extends BaseComponent
{
    public function __construct(
        public string $name,
        public string $size = 'md',
        public string $color = 'current',
    ) {}

    public function svgContent(): ?string
    {
        return IconRegistry::get($this->name);
    }

    public function sizeClasses(): string
    {
        return IconRegistry::sizeClasses($this->size);
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
            'inline-block shrink-0',
            $this->sizeClasses(),
            $this->colorClasses()
        );
    }

    public function render(): View
    {
        /** @var View $view */
        $view = view('prisma::components.icon', [
            'classes' => $this->classes(),
            'svgContent' => $this->svgContent(),
        ]);

        return $view;
    }
}
