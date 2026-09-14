<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Commands;

use Illuminate\Console\Command;

class EjectCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'prisma:eject {component? : Nombre opcional del componente a expulsar}';

    /**
     * @var string
     */
    protected $description = 'Expulsa los componentes Blade hacia la aplicación local para personalización total';

    public function handle(): int
    {
        $this->info('Expulsor de componentes de Prisma 11');
        return self::SUCCESS;
    }
}
