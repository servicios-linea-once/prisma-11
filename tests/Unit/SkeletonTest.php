<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Unit;

use ServicioLineaOnce\Prisma11\Tests\TestCase;
use ServicioLineaOnce\Prisma11\PrismaServiceProvider;

class SkeletonTest extends TestCase
{
    public function test_service_provider_is_registered(): void
    {
        $providers = $this->app->getLoadedProviders();
        $this->assertArrayHasKey(PrismaServiceProvider::class, $providers);
    }
}
