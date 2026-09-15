<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;
use ServicioLineaOnce\Prisma11\View\Components\Forms\FormField;

class Radio extends FormField
{
    public function __construct(
        public string $value = '',
        ?string $name = null,
        ?string $id = null,
        ?string $label = null,
        ?string $hint = null,
        public ?string $description = null,
        public bool $checked = false,
        public string $color = 'primary',
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

    public function radioClasses(bool $hasError): string
    {
        $base = 'w-4 h-4 rounded-full border transition-colors focus:ring-2 focus:ring-offset-1 disabled:opacity-50 cursor-pointer bg-light dark:bg-dark';

        $colorClasses = $hasError
            ? 'border-danger text-danger focus:ring-danger-ring'
            : "border-secondary/40 text-{$this->color} focus:ring-{$this->color}-ring";

        return $this->mergeClasses($base, $colorClasses);
    }

    public function render(): View
    {
        $resolved = $this->resolveModifiers([
            'color' => $this->color === 'primary' ? null : $this->color,
            'defaultColor' => 'primary',
        ]);
        $this->color = $resolved['color'];

        /** @var View $view */
        $view = view('prisma::components.radio');

        return $view;
    }
}
