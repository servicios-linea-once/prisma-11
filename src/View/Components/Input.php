<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;
use ServicioLineaOnce\Prisma11\View\Components\Forms\FormField;

class Input extends FormField
{
    public function __construct(
        ?string $name = null,
        ?string $id = null,
        ?string $label = null,
        ?string $hint = null,
        public string $type = 'text',
        public ?string $prefix = null,
        public ?string $suffix = null,
        public ?string $iconLeading = null,
        public ?string $iconTrailing = null,
        public string $size = 'md',
        public bool $clearable = false,
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

    public function inputClasses(bool $hasError, bool $hasLeading = false, bool $hasTrailing = false): string
    {
        $base = 'w-full rounded-md transition-all duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-1 disabled:opacity-50 disabled:cursor-not-allowed bg-light dark:bg-dark text-dark dark:text-light placeholder:text-secondary/60';

        $sizeClasses = match ($this->size) {
            'sm' => 'text-xs py-1.5 ' . ($hasLeading ? 'ps-8' : 'ps-2.5') . ' ' . ($hasTrailing ? 'pe-8' : 'pe-2.5'),
            'lg' => 'text-base py-3 ' . ($hasLeading ? 'ps-11' : 'ps-4') . ' ' . ($hasTrailing ? 'pe-11' : 'pe-4'),
            default => 'text-sm py-2.5 ' . ($hasLeading ? 'ps-9' : 'ps-3.5') . ' ' . ($hasTrailing ? 'pe-9' : 'pe-3.5'),
        };

        $borderClasses = $hasError
            ? 'border border-danger focus:border-danger focus-visible:ring-danger-ring'
            : 'border border-secondary/30 focus:border-primary focus-visible:ring-primary-ring';

        return $this->mergeClasses($base, $sizeClasses, $borderClasses);
    }

    public function render(): View
    {
        return view('prisma::components.input');
    }
}
