<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Supermarket;

use PeterPecosz\ShoppingPlanner\Supermarket\CategoryMap;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CategoryMapTest extends TestCase
{
    private CategoryMap $sut;

    protected function setUp(): void
    {
        $this->sut = new CategoryMap(
            [
                'Bor' => 'Tejtermék',
            ]
        );
    }

    #[Test]
    public function testMap(): void
    {
        $this->assertEquals('Tejtermék', $this->sut->map('Bor'));
    }

    #[Test]
    public function testMapWhenKategoriaNotFoundInMap(): void
    {
        $this->assertEquals('Tejtermék', $this->sut->map('Tejtermék'));
    }
}
