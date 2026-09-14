<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class FormContextBindingTest extends TestCase
{
    public function test_input_infers_id_and_label_relationship_from_name(): void
    {
        $rendered = Blade::render('<x-prisma-input name="email" label="Correo Electrónico" />');

        $this->assertStringContainsString('<label for="email"', $rendered);
        $this->assertStringContainsString('Correo Electrónico', $rendered);
        $this->assertStringContainsString('id="email"', $rendered);
        $this->assertStringContainsString('name="email"', $rendered);
    }

    public function test_input_infers_name_and_id_from_wire_model(): void
    {
        $rendered = Blade::render('<x-prisma-input wire:model="username" label="Usuario" />');

        $this->assertStringContainsString('<label for="username"', $rendered);
        $this->assertStringContainsString('id="username"', $rendered);
        $this->assertStringContainsString('wire:model="username"', $rendered);
    }

    public function test_input_detects_laravel_error_bag_and_renders_error_message(): void
    {
        $errors = new ViewErrorBag();
        $messageBag = new MessageBag([
            'email' => ['El correo electrónico ya se encuentra registrado.'],
        ]);
        $errors->put('default', $messageBag);
        View::share('errors', $errors);

        $rendered = Blade::render('<x-prisma-input name="email" label="Correo" />');

        $this->assertStringContainsString('aria-invalid="true"', $rendered);
        $this->assertStringContainsString('aria-describedby="email-error"', $rendered);
        $this->assertStringContainsString('El correo electrónico ya se encuentra registrado.', $rendered);
        $this->assertStringContainsString('border-danger', $rendered);
    }

    public function test_input_renders_hint_and_slots(): void
    {
        $rendered = Blade::render('<x-prisma-input name="token" label="Token" hint="Introduce el código de 6 dígitos" prefix="@" />');

        $this->assertStringContainsString('Introduce el código de 6 dígitos', $rendered);
        $this->assertStringContainsString('aria-describedby="token-hint"', $rendered);
        $this->assertStringContainsString('@', $rendered);
    }
}
