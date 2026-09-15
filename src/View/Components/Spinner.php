<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;

class Spinner extends BaseComponent
{
    public function __construct(
        public ?string $size = null,
        public ?string $color = null,
    ) {}

    public function sizeClasses(): string
    {
        $sizeKey = $this->size ?? 'md';
        return match ($sizeKey) {
            'xs' => 'w-3 h-3',
            'sm' => 'w-4 h-4',
            'lg' => 'w-8 h-8',
            'xl' => 'w-12 h-12',
            default => 'w-5 h-5', // md
        };
    }

    public function colorClasses(): string
    {
        $colorKey = $this->color ?? 'primary';
        if ($colorKey === 'current') {
            return 'text-current';
        }

        return match ($colorKey) {
            'success', 'green' => 'text-green-600',
            'danger', 'red' => 'text-red-600',
            'warning', 'yellow' => 'text-yellow-500',
            'info', 'blue' => 'text-blue-600',
            'dark', 'gray' => 'text-gray-900 dark:text-gray-100',
            default => "text-{$colorKey}",
        };
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
        $resolved = $this->resolveModifiers([
            'color' => $this->color,
            'size' => $this->size,
            'defaultColor' => 'primary',
            'defaultSize' => 'md',
        ]);

        $this->color = $resolved['color'];
        $this->size = $resolved['size'];

        /** @var View $view */
        $view = view('prisma::components.spinner', [
            'classes' => $this->classes(),
            'color' => $this->color,
            'size' => $this->size,
        ]);

        return $view;
    }
}
