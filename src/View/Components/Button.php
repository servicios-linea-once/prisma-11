<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;

class Button extends BaseComponent
{
    public string $as;

    public function __construct(
        ?string $as = null,
        public ?string $variant = 'solid',
        public ?string $color = 'primary',
        public ?string $size = 'md',
        public ?string $rounded = 'md',
        public bool $loading = false,
        public bool $disabled = false,
        public ?string $iconLeading = null,
        public ?string $iconTrailing = null,
        public ?string $href = null,
    ) {
        $this->as = $as ?? ($this->href !== null ? 'a' : 'button');
    }

    public function computeClasses(string $color, string $size, string $variant, string $rounded): string
    {
        $base = 'inline-flex items-center justify-center font-medium transition-all duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none cursor-pointer select-none';

        $sizeClasses = match ($size) {
            'xs' => 'text-xs px-2.5 py-1.5 gap-1.5',
            'sm' => 'text-sm px-3 py-2 gap-2',
            'lg' => 'text-base px-5 py-3 gap-2.5',
            'xl' => 'text-base px-6 py-3.5 gap-3',
            default => 'text-sm px-4 py-2.5 gap-2',
        };

        $roundedClasses = match ($rounded) {
            'none' => 'rounded-none',
            'sm' => 'rounded-sm',
            'lg' => 'rounded-lg',
            'full' => 'rounded-full',
            default => 'rounded-md',
        };

        $variantClasses = match ($color) {
            'success', 'green' => match ($variant) {
                'outline' => 'border border-green-600 border-success text-green-600 text-success hover:bg-green-50 focus-visible:ring-green-500 dark:border-green-500 dark:text-green-500 dark:hover:bg-green-950/30',
                'ghost' => 'text-green-600 text-success hover:bg-green-50 focus-visible:ring-green-500 dark:text-green-400 dark:hover:bg-green-950/30',
                'link' => 'text-green-600 text-success underline-offset-4 hover:underline focus-visible:ring-green-500 dark:text-green-400 p-0 h-auto',
                default => 'bg-green-600 bg-success text-white text-success-fg hover:bg-green-700 focus-visible:ring-green-500 dark:bg-green-600 dark:hover:bg-green-700',
            },
            'danger', 'red' => match ($variant) {
                'outline' => 'border border-red-600 border-danger text-red-600 text-danger hover:bg-red-50 focus-visible:ring-red-500 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-950/30',
                'ghost' => 'text-red-600 text-danger hover:bg-red-50 focus-visible:ring-red-500 dark:text-red-400 dark:hover:bg-red-950/30',
                'link' => 'text-red-600 text-danger underline-offset-4 hover:underline focus-visible:ring-red-500 dark:text-red-400 p-0 h-auto',
                default => 'bg-red-600 bg-danger text-white text-danger-fg hover:bg-red-700 focus-visible:ring-red-500 dark:bg-red-600 dark:hover:bg-red-700',
            },
            'warning', 'yellow' => match ($variant) {
                'outline' => 'border border-yellow-500 border-warning text-yellow-600 text-warning hover:bg-yellow-50 focus-visible:ring-yellow-400 dark:border-yellow-400 dark:text-yellow-400 dark:hover:bg-yellow-950/30',
                'ghost' => 'text-yellow-600 text-warning hover:bg-yellow-50 focus-visible:ring-yellow-400 dark:text-yellow-400 dark:hover:bg-yellow-950/30',
                'link' => 'text-yellow-600 text-warning underline-offset-4 hover:underline focus-visible:ring-yellow-400 dark:text-yellow-400 p-0 h-auto',
                default => 'bg-yellow-500 bg-warning text-white text-warning-fg hover:bg-yellow-600 focus-visible:ring-yellow-400 dark:bg-yellow-500 dark:hover:bg-yellow-600',
            },
            'info', 'blue' => match ($variant) {
                'outline' => 'border border-blue-600 border-info text-blue-600 text-info hover:bg-blue-50 focus-visible:ring-blue-500 dark:border-blue-500 dark:text-blue-500 dark:hover:bg-blue-950/30',
                'ghost' => 'text-blue-600 text-info hover:bg-blue-50 focus-visible:ring-blue-500 dark:text-blue-400 dark:hover:bg-blue-950/30',
                'link' => 'text-blue-600 text-info underline-offset-4 hover:underline focus-visible:ring-blue-500 dark:text-blue-400 p-0 h-auto',
                default => 'bg-blue-600 bg-info text-white text-info-fg hover:bg-blue-700 focus-visible:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-700',
            },
            'dark' => match ($variant) {
                'outline' => 'border border-gray-900 text-gray-900 hover:bg-gray-100 focus-visible:ring-gray-700 dark:border-gray-400 dark:text-gray-300 dark:hover:bg-gray-800',
                'ghost' => 'text-gray-900 hover:bg-gray-100 focus-visible:ring-gray-700 dark:text-gray-300 dark:hover:bg-gray-800',
                'link' => 'text-gray-900 underline-offset-4 hover:underline focus-visible:ring-gray-700 dark:text-gray-300 p-0 h-auto',
                default => 'bg-gray-900 text-white hover:bg-black focus-visible:ring-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600',
            },
            'light', 'alternative' => match ($variant) {
                'outline' => 'border border-gray-300 text-gray-700 hover:bg-gray-50 focus-visible:ring-gray-300 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-800',
                'ghost' => 'text-gray-700 hover:bg-gray-100 focus-visible:ring-gray-300 dark:text-gray-300 dark:hover:bg-gray-800',
                'link' => 'text-gray-700 underline-offset-4 hover:underline focus-visible:ring-gray-300 dark:text-gray-300 p-0 h-auto',
                default => 'bg-white text-gray-900 border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus-visible:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700',
            },
            default => match ($variant) {
                'outline' => "border border-{$color}-border text-{$color} hover:bg-{$color}/10 focus-visible:ring-{$color}-ring",
                'ghost' => "text-{$color} hover:bg-{$color}/10 focus-visible:ring-{$color}-ring",
                'link' => "text-{$color} underline-offset-4 hover:underline focus-visible:ring-{$color}-ring p-0 h-auto",
                default => "bg-{$color} text-{$color}-fg hover:opacity-90 focus-visible:ring-{$color}-ring",
            },
        };

        return $this->mergeClasses($base, $sizeClasses, $roundedClasses, $variantClasses);
    }

    public function classes(): string
    {
        return $this->computeClasses(
            $this->color ?? 'primary',
            $this->size ?? 'md',
            $this->variant ?? 'solid',
            $this->rounded ?? 'md'
        );
    }

    public function render(): View
    {
        /** @var View $view */
        $view = view('prisma::components.button', [
            'component' => $this,
            'classes' => $this->classes(),
            'size' => $this->size ?? 'md',
            'color' => $this->color ?? 'primary',
            'variant' => $this->variant ?? 'solid',
            'rounded' => $this->rounded ?? 'md',
        ]);

        return $view;
    }
}
