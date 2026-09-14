<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;
use ServicioLineaOnce\Prisma11\View\Components\Forms\FormField;

class Textarea extends FormField
{
    public function __construct(
        ?string $name = null,
        ?string $id = null,
        ?string $label = null,
        ?string $hint = null,
        public int $rows = 4,
        public string $resize = 'y',
        public ?int $maxlength = null,
        public bool $showCounter = false,
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

    public function textareaClasses(bool $hasError): string
    {
        $base = 'w-full rounded-md px-3.5 py-2.5 text-sm transition-all duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-1 disabled:opacity-50 disabled:cursor-not-allowed bg-light dark:bg-dark text-dark dark:text-light placeholder:text-secondary/60';

        $resizeClasses = match ($this->resize) {
            'none' => 'resize-none',
            'x' => 'resize-x',
            'both' => 'resize',
            default => 'resize-y',
        };

        $borderClasses = $hasError
            ? 'border border-danger focus:border-danger focus-visible:ring-danger-ring'
            : 'border border-secondary/30 focus:border-primary focus-visible:ring-primary-ring';

        return $this->mergeClasses($base, $resizeClasses, $borderClasses);
    }

    public function render(): View
    {
        return view('prisma::components.textarea');
    }
}
