<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;

class Badge extends BaseComponent
{
    public function __construct(
        public ?string $color = 'primary',
        public ?string $size = 'sm',
        public ?string $variant = 'solid',
        public ?string $rounded = 'full',
    ) {}

    public function computeClasses(string $color, string $size, string $variant, string $rounded): string
    {
        $base = 'inline-flex items-center font-medium select-none';

        $sizeClasses = match ($size) {
            'xs' => 'text-[10px] px-1.5 py-0.5 gap-1',
            'md' => 'text-xs px-2.5 py-1 gap-1.5',
            'lg' => 'text-sm px-3 py-1 gap-2',
            default => 'text-xs px-2 py-0.5 gap-1', // sm
        };

        $roundedClasses = match ($rounded) {
            'none' => 'rounded-none',
            'sm' => 'rounded-sm',
            'md' => 'rounded-md',
            default => 'rounded-full',
        };

        $variantClasses = match ($color) {
            'success', 'green' => match ($variant) {
                'outline' => 'border border-green-600 border-success text-green-600 text-success dark:border-green-500 dark:text-green-400 bg-transparent',
                'dot' => 'bg-green-500',
                default => 'bg-green-100 bg-success text-green-800 text-success-fg dark:bg-green-900 dark:text-green-300',
            },
            'danger', 'red' => match ($variant) {
                'outline' => 'border border-red-600 border-danger text-red-600 text-danger dark:border-red-500 dark:text-red-400 bg-transparent',
                'dot' => 'bg-red-500',
                default => 'bg-red-100 bg-danger text-red-800 text-danger-fg dark:bg-red-900 dark:text-red-300',
            },
            'warning', 'yellow' => match ($variant) {
                'outline' => 'border border-yellow-500 text-yellow-600 dark:border-yellow-400 dark:text-yellow-400 bg-transparent',
                'dot' => 'bg-yellow-500',
                default => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            },
            'info', 'blue' => match ($variant) {
                'outline' => 'border border-blue-600 text-blue-600 dark:border-blue-500 dark:text-blue-400 bg-transparent',
                'dot' => 'bg-blue-500',
                default => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
            },
            'dark' => match ($variant) {
                'outline' => 'border border-gray-700 text-gray-800 dark:border-gray-500 dark:text-gray-300 bg-transparent',
                'dot' => 'bg-gray-700',
                default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
            },
            'purple' => match ($variant) {
                'outline' => 'border border-purple-600 text-purple-600 dark:border-purple-500 dark:text-purple-400 bg-transparent',
                'dot' => 'bg-purple-500',
                default => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
            },
            default => match ($variant) {
                'outline' => "border border-{$color}-border text-{$color} bg-transparent",
                'dot' => "bg-{$color}/10 text-{$color}",
                default => "bg-{$color} text-{$color}-fg",
            },
        };

        return $this->mergeClasses($base, $sizeClasses, $roundedClasses, $variantClasses);
    }

    public function classes(): string
    {
        return $this->computeClasses(
            $this->color ?? 'primary',
            $this->size ?? 'sm',
            $this->variant ?? 'solid',
            $this->rounded ?? 'full'
        );
    }

    public function render(): View
    {
        /** @var View $view */
        $view = view('prisma::components.badge', [
            'component' => $this,
            'classes' => $this->classes(),
            'color' => $this->color ?? 'primary',
            'size' => $this->size ?? 'sm',
            'variant' => $this->variant ?? 'solid',
            'rounded' => $this->rounded ?? 'full',
        ]);

        return $view;
    }
}
