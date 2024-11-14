<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Supermarket;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use PeterPecosz\ShoppingPlanner\Supermarket\IngredientToCategoryMap;
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
        $this->assertEquals('Felvágott', $this->sut->map(new Ingredient('Trappista sajt', 1, Measure::G, 'Sajt')));
    }

    #[Test]
    public function testMapWhenHozzavaloNotFoundInMap(): void
    {
        $this->assertEquals('Sajt', $this->sut->map(new Ingredient('Feta sajt', 1, Measure::G, 'Sajt')));
    }
}
