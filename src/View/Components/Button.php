<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;

class Button extends BaseComponent
{
    public string $as;

    public function __construct(
        ?string $as = null,
        public string $variant = 'solid',
        public string $color = 'primary',
        public string $size = 'md',
        public string $rounded = 'md',
        public bool $loading = false,
        public bool $disabled = false,
        public ?string $iconLeading = null,
        public ?string $iconTrailing = null,
        public ?string $href = null,
    ) {
        $this->as = $as ?? ($this->href !== null ? 'a' : 'button');
    }

    public function classes(): string
    {
        $base = 'inline-flex items-center justify-center font-medium transition-all duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none cursor-pointer select-none';

        $sizeClasses = match ($this->size) {
            'xs' => 'text-xs px-2.5 py-1.5 gap-1.5',
            'sm' => 'text-sm px-3 py-2 gap-2',
            'lg' => 'text-base px-5 py-3 gap-2.5',
            'xl' => 'text-base px-6 py-3.5 gap-3',
            default => 'text-sm px-4 py-2.5 gap-2',
        };

        $roundedClasses = match ($this->rounded) {
            'none' => 'rounded-none',
            'sm' => 'rounded-sm',
            'lg' => 'rounded-lg',
            'full' => 'rounded-full',
            default => 'rounded-md',
        };

        $variantClasses = match ($this->variant) {
            'outline' => "border border-{$this->color}-border text-{$this->color} hover:bg-{$this->color}/10 focus-visible:ring-{$this->color}-ring",
            'ghost' => "text-{$this->color} hover:bg-{$this->color}/10 focus-visible:ring-{$this->color}-ring",
            'link' => "text-{$this->color} underline-offset-4 hover:underline focus-visible:ring-{$this->color}-ring p-0 h-auto",
            default => "bg-{$this->color} text-{$this->color}-fg hover:opacity-90 focus-visible:ring-{$this->color}-ring",
        };

        return $this->mergeClasses($base, $sizeClasses, $roundedClasses, $variantClasses);
    }

    public function render(): View
    {
        return view('prisma::components.button');
    }
}
