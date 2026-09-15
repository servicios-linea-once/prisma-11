<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;

class Alert extends BaseComponent
{
    public function __construct(
        public string $color = 'info',
        public ?string $title = null,
        public ?string $icon = null,
        public bool $dismissible = false,
        public string $variant = 'subtle',
    ) {
        if ($this->icon === null) {
            $this->icon = match ($this->color) {
                'success' => 'check-circle',
                'danger' => 'alert-circle',
                'warning' => 'alert-triangle',
                'info' => 'info',
                default => 'info',
            };
        }
    }

    public function classes(): string
    {
        $base = 'relative w-full rounded-lg p-4 transition-all duration-150 flex items-start gap-3';

        $variantClasses = match ($this->variant) {
            'solid' => "bg-{$this->color} text-{$this->color}-fg border border-{$this->color}-border",
            'outline' => "border-2 border-{$this->color}-border text-{$this->color} bg-transparent",
            default => "bg-{$this->color}/10 border border-{$this->color}/20 text-dark dark:text-light", // subtle
        };

        return $this->mergeClasses($base, $variantClasses);
    }

    public function render(): View
    {
        /** @var View $view */
        $view = view('prisma::components.alert', [
            'classes' => $this->classes(),
        ]);

        return $view;
    }
}
