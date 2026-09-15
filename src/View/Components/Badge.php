<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;

class Badge extends BaseComponent
{
    public function __construct(
        public string $color = 'primary',
        public string $size = 'sm',
        public string $variant = 'solid',
        public string $rounded = 'full',
    ) {}

    public function classes(): string
    {
        $base = 'inline-flex items-center font-medium select-none';

        $sizeClasses = match ($this->size) {
            'xs' => 'text-[10px] px-1.5 py-0.5 gap-1',
            'md' => 'text-xs px-2.5 py-1 gap-1.5',
            'lg' => 'text-sm px-3 py-1 gap-2',
            default => 'text-xs px-2 py-0.5 gap-1', // sm
        };

        $roundedClasses = match ($this->rounded) {
            'none' => 'rounded-none',
            'sm' => 'rounded-sm',
            'md' => 'rounded-md',
            default => 'rounded-full',
        };

        $variantClasses = match ($this->variant) {
            'outline' => "border border-{$this->color}-border text-{$this->color} bg-transparent",
            'dot' => "bg-{$this->color}/10 text-{$this->color}",
            default => "bg-{$this->color} text-{$this->color}-fg",
        };

        return $this->mergeClasses($base, $sizeClasses, $roundedClasses, $variantClasses);
    }

    public function render(): View
    {
        /** @var View $view */
        $view = view('prisma::components.badge', [
            'classes' => $this->classes(),
        ]);

        return $view;
    }
}
