<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;

class Alert extends BaseComponent
{
    public function __construct(
        public ?string $color = 'info',
        public ?string $title = null,
        public ?string $icon = null,
        public bool $dismissible = false,
        public ?string $variant = 'subtle',
    ) {
        if ($this->icon === null && $this->color !== null) {
            $this->icon = match ($this->color) {
                'success', 'green' => 'check-circle',
                'danger', 'red' => 'alert-circle',
                'warning', 'yellow' => 'alert-triangle',
                'info', 'blue' => 'info',
                default => 'info',
            };
        }
    }

    public function computeClasses(string $color, string $variant): string
    {
        $base = 'relative w-full rounded-lg p-4 transition-all duration-150 flex items-start gap-3';

        $colorClasses = match ($color) {
            'success', 'green' => match ($variant) {
                'solid' => 'bg-green-600 text-white border border-green-700',
                'outline' => 'border-2 border-green-600 text-green-600 bg-transparent dark:border-green-500 dark:text-green-400',
                default => 'bg-green-50 border border-green-200 text-green-800 dark:bg-gray-800 dark:text-green-400 dark:border-green-800 border-success',
            },
            'danger', 'red' => match ($variant) {
                'solid' => 'bg-red-600 text-white border border-red-700',
                'outline' => 'border-2 border-red-600 text-red-600 bg-transparent dark:border-red-500 dark:text-red-400',
                default => 'bg-red-50 border border-red-200 text-red-800 dark:bg-gray-800 dark:text-red-400 dark:border-red-800 border-danger',
            },
            'warning', 'yellow' => match ($variant) {
                'solid' => 'bg-yellow-500 text-white border border-yellow-600',
                'outline' => 'border-2 border-yellow-500 text-yellow-600 bg-transparent dark:border-yellow-400 dark:text-yellow-400',
                default => 'bg-yellow-50 border border-yellow-200 text-yellow-800 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800 border-warning',
            },
            'info', 'blue' => match ($variant) {
                'solid' => 'bg-blue-600 text-white border border-blue-700',
                'outline' => 'border-2 border-blue-600 text-blue-600 bg-transparent dark:border-blue-500 dark:text-blue-400',
                default => 'bg-blue-50 border border-blue-200 text-blue-800 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800 border-info',
            },
            default => match ($variant) {
                'solid' => "bg-{$color} text-{$color}-fg border border-{$color}-border",
                'outline' => "border-2 border-{$color}-border text-{$color} bg-transparent",
                default => "bg-{$color}/10 border border-{$color}/20 text-dark dark:text-light border-{$color}",
            },
        };

        return $this->mergeClasses($base, $colorClasses);
    }

    public function classes(): string
    {
        return $this->computeClasses(
            $this->color ?? 'info',
            $this->variant ?? 'subtle'
        );
    }

    public function render(): View
    {
        /** @var View $view */
        $view = view('prisma::components.alert', [
            'component' => $this,
            'classes' => $this->classes(),
            'dismissible' => $this->dismissible,
            'icon' => $this->icon,
            'title' => $this->title,
            'color' => $this->color ?? 'info',
            'variant' => $this->variant ?? 'subtle',
        ]);

        return $view;
    }
}
