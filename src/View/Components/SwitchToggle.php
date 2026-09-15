<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;
use ServicioLineaOnce\Prisma11\View\Components\Forms\FormField;

class SwitchToggle extends FormField
{
    public function __construct(
        ?string $name = null,
        ?string $id = null,
        ?string $label = null,
        ?string $hint = null,
        public ?string $description = null,
        public bool $checked = false,
        public string $color = 'primary',
        public string $size = 'md',
        bool $required = false,
        bool $disabled = false,
        bool $readonly = false,
    ) {
        parent::__construct(
            name: $name,
            id: $id,
            label: $label,
            hint: $hint,
            required: $required,
            disabled: $disabled,
            readonly: $readonly
        );
    }

    public function trackClasses(bool $hasError): string
    {
        $base = 'relative inline-flex shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

        $sizeClasses = match ($this->size) {
            'sm' => 'h-5 w-9',
            'lg' => 'h-7 w-14',
            default => 'h-6 w-11', // md
        };

        $focusRing = $hasError ? 'focus:ring-danger-ring' : "focus:ring-{$this->color}-ring";

        return $this->mergeClasses($base, $sizeClasses, $focusRing);
    }

    public function thumbClasses(): string
    {
        $base = 'pointer-events-none inline-block rounded-full bg-white shadow-sm ring-0 transition duration-200 ease-in-out';

        return match ($this->size) {
            'sm' => "{$base} h-4 w-4",
            'lg' => "{$base} h-6 w-6",
            default => "{$base} h-5 w-5", // md
        };
    }

    public function translateClasses(): string
    {
        return match ($this->size) {
            'sm' => "on ? 'translate-x-4' : 'translate-x-0'",
            'lg' => "on ? 'translate-x-7' : 'translate-x-0'",
            default => "on ? 'translate-x-5' : 'translate-x-0'",
        };
    }

    public function render(): View
    {
        /** @var View $view */
        $view = view('prisma::components.switch');

        return $view;
    }
}
