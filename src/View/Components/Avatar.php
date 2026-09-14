<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;

class Avatar extends BaseComponent
{
    public function __construct(
        public ?string $src = null,
        public ?string $name = null,
        public string $size = 'md',
        public ?string $status = null,
        public string $rounded = 'full',
    ) {}

    public function initials(): string
    {
        if (!$this->name) {
            return '';
        }

        $words = preg_split('/\s+/', trim($this->name)) ?: [];
        $initials = '';

        foreach (array_slice($words, 0, 2) as $word) {
            if ($word !== '') {
                $initials .= mb_strtoupper(mb_substr($word, 0, 1));
            }
        }

        return $initials ?: '?';
    }

    public function sizeClasses(): string
    {
        return match ($this->size) {
            'xs' => 'w-6 h-6 text-[10px]',
            'sm' => 'w-8 h-8 text-xs',
            'lg' => 'w-12 h-12 text-base',
            'xl' => 'w-16 h-16 text-xl',
            default => 'w-10 h-10 text-sm', // md
        };
    }

    public function statusClasses(): string
    {
        $statusColor = match ($this->status) {
            'online' => 'bg-success',
            'offline' => 'bg-secondary',
            'busy' => 'bg-danger',
            'away' => 'bg-warning',
            default => '',
        };

        $statusSize = match ($this->size) {
            'xs' => 'w-1.5 h-1.5',
            'sm' => 'w-2 h-2',
            'lg' => 'w-3 h-3',
            'xl' => 'w-4 h-4',
            default => 'w-2.5 h-2.5',
        };

        return "absolute bottom-0 end-0 rounded-full ring-2 ring-light dark:ring-dark {$statusColor} {$statusSize}";
    }

    public function classes(): string
    {
        $roundedClass = $this->rounded === 'full' ? 'rounded-full' : ($this->rounded === 'lg' ? 'rounded-lg' : 'rounded-md');

        return $this->mergeClasses(
            'relative inline-flex items-center justify-center shrink-0 font-medium select-none overflow-hidden bg-secondary/20 text-secondary-fg dark:bg-secondary/40',
            $this->sizeClasses(),
            $roundedClass
        );
    }

    public function render(): View
    {
        return view('prisma::components.avatar');
    }
}
