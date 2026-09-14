<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Commands;

use Illuminate\Console\Command;

class DoctorCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'prisma:doctor';

    /**
     * @var string
     */
    protected $description = 'Audita el entorno y diagnostica la configuración de Tailwind, Alpine y Livewire';

    public function handle(): int
    {
        $this->info('Diagnóstico de Prisma 11');
        return self::SUCCESS;
    }
}
