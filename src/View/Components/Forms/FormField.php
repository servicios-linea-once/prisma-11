<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\View\Components\Forms;

use Illuminate\View\ComponentAttributeBag;
use Illuminate\Support\ViewErrorBag;
use ServicioLineaOnce\Prisma11\View\Components\BaseComponent;

abstract class FormField extends BaseComponent
{
    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public ?string $label = null,
        public ?string $hint = null,
        public bool $required = false,
        public bool $disabled = false,
        public bool $readonly = false,
    ) {}

    /**
     * Resuelve el nombre del campo a partir del atributo name o directiva wire:model.
     */
    public function resolveName(ComponentAttributeBag $attributes): ?string
    {
        if ($this->name !== null && $this->name !== '') {
            return $this->name;
        }

        foreach ($attributes->getAttributes() as $key => $value) {
            if (str_starts_with($key, 'wire:model') && is_string($value)) {
                return $value;
            }
        }

        return null;
    }

    /**
     * Resuelve el identificador único accesible del campo.
     */
    public function resolveId(ComponentAttributeBag $attributes): string
    {
        if ($this->id !== null && $this->id !== '') {
            return $this->id;
        }

        $resolvedName = $this->resolveName($attributes);
        if ($resolvedName !== null && $resolvedName !== '') {
            return str_replace(['[', ']', '.'], ['_', '', '_'], $resolvedName);
        }

        return 'p11_' . substr(md5(uniqid((string) mt_rand(), true)), 0, 8);
    }

    /**
     * Comprueba si el campo tiene un error en el ViewErrorBag actual de Laravel.
     */
    public function hasError(?string $name): bool
    {
        if ($name === null || $name === '') {
            return false;
        }

        /** @var ViewErrorBag|null $errors */
        $errors = \Illuminate\Support\Facades\View::shared('errors');

        return $errors instanceof ViewErrorBag && $errors->has($name);
    }

    /**
     * Devuelve el primer mensaje de error para el campo.
     */
    public function errorMessage(?string $name): ?string
    {
        if ($name === null || $name === '') {
            return null;
        }

        /** @var ViewErrorBag|null $errors */
        $errors = \Illuminate\Support\Facades\View::shared('errors');

        return $errors instanceof ViewErrorBag ? $errors->first($name) : null;
    }

    /**
     * Calcula los IDs vinculados para aria-describedby.
     */
    public function ariaDescribedBy(string $id, bool $hasError, bool $hasHint): ?string
    {
        $ids = [];
        if ($hasError) {
            $ids[] = "{$id}-error";
        } elseif ($hasHint) {
            $ids[] = "{$id}-hint";
        }

        return !empty($ids) ? implode(' ', $ids) : null;
    }
}
