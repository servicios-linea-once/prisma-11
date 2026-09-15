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
        public ?string $flip = null,
        public ?string $rotate = null,
    ) {}

    public function iconName(): string
    {
        return IconRegistry::resolveIconName($this->name);
    }

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
            'inline-block shrink-0 align-middle',
            $this->sizeClasses(),
            $this->colorClasses()
        );
    }

    public function render(): View
    {
        /** @var View $view */
        $view = view('prisma::components.icon', [
            'name' => $this->name,
            'iconName' => $this->iconName(),
            'classes' => $this->classes(),
            'svgContent' => $this->svgContent(),
            'flip' => $this->flip,
            'rotate' => $this->rotate,
        ]);

        return $view;
    }
}
