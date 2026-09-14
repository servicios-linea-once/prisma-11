<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ServicioLineaOnce\Prisma11\Support\TailwindClassMerge;

class TailwindClassMergeTest extends TestCase
{
    public function test_merges_simple_padding_classes(): void
    {
        $result = TailwindClassMerge::merge('p-4', 'p-2');
        $this->assertEquals('p-2', $result);
    }

    public function test_merges_axis_padding_classes(): void
    {
        $result = TailwindClassMerge::merge('px-4', 'px-6');
        $this->assertEquals('px-6', $result);
    }

    public function test_merges_background_colors(): void
    {
        $result = TailwindClassMerge::merge('bg-primary', 'bg-danger');
        $this->assertEquals('bg-danger', $result);
    }

    public function test_keeps_different_variants_distinct(): void
    {
        $result = TailwindClassMerge::merge('bg-primary', 'hover:bg-danger');
        $this->assertEquals('bg-primary hover:bg-danger', $result);
    }

    public function test_merges_same_variant_classes(): void
    {
        $result = TailwindClassMerge::merge('hover:bg-primary', 'hover:bg-danger');
        $this->assertEquals('hover:bg-danger', $result);
    }

    public function test_merges_logical_properties(): void
    {
        $result = TailwindClassMerge::merge('ms-2', 'ms-4', 'ps-1', 'ps-3');
        $this->assertEquals('ms-4 ps-3', $result);
    }

    public function test_merges_text_sizes(): void
    {
        $result = TailwindClassMerge::merge('text-sm', 'text-base', 'text-xl');
        $this->assertEquals('text-xl', $result);
    }

    public function test_handles_multiple_arguments_and_extra_whitespace(): void
    {
        $result = TailwindClassMerge::merge('  font-bold   text-center ', 'font-normal');
        $this->assertEquals('font-normal text-center', $result);
    }

    public function test_handles_null_and_empty_arguments(): void
    {
        $result = TailwindClassMerge::merge('bg-red-500', null, '', 'bg-blue-500', null);
        $this->assertEquals('bg-blue-500', $result);
    }
}
