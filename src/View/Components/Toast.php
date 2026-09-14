<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components;

use Illuminate\Contracts\View\View;

class Toast extends BaseComponent
{
    public function __construct(
        public string $position = 'top-end',
        public int $duration = 4000,
    ) {}

    public function positionClasses(): string
    {
        return match ($this->position) {
            'top-start' => 'top-4 start-4 items-start',
            'top-center' => 'top-4 start-1/2 -translate-x-1/2 items-center',
            'bottom-end' => 'bottom-4 end-4 items-end',
            'bottom-start' => 'bottom-4 start-4 items-start',
            'bottom-center' => 'bottom-4 start-1/2 -translate-x-1/2 items-center',
            default => 'top-4 end-4 items-end', // top-end
        };
    }

    public function render(): View
    {
        return view('prisma::components.toast');
    }
}
