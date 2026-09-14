<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'prisma:install';

    /**
     * @var string
     */
    protected $description = 'Instala y configura de forma interactiva Prisma 11 en tu aplicación Laravel';

    public function handle(): int
    {
        $this->info('Instalador de Prisma 11');
        return self::SUCCESS;
    }
}
