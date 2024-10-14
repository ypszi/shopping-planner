<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\Supermarket\IngredientToCategoryMap;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class IngredientToCategoryMapTest extends TestCase
{
    private IngredientToCategoryMap $sut;

    protected function setUp(): void
    {
        $this->sut = new IngredientToCategoryMap(
            [
                'Trappista sajt' => 'Felvágott',
            ]
        );
    }

    #[Test]
    public function testMap(): void
    {
        $this->assertEquals('Felvágott', $this->sut->map(new Hozzavalo('Trappista sajt', 1, Mertekegyseg::G, 'Sajt')));
    }

    #[Test]
    public function testMapWhenHozzavaloNotFoundInMap(): void
    {
        $this->assertEquals('Sajt', $this->sut->map(new Hozzavalo('Feta sajt', 1, Mertekegyseg::G, 'Sajt')));
    }
}
