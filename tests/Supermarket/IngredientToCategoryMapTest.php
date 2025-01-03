<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Supermarket;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
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
        $this->assertEquals('Felvágott', $this->sut->map(new IngredientForFood(name: 'Trappista sajt', category: 'Sajt', portion: 1, measure: Measure::G)));
    }

    #[Test]
    public function testMapWhenHozzavaloNotFoundInMap(): void
    {
        $this->assertEquals('Sajt', $this->sut->map(new IngredientForFood(name: 'Feta sajt', category: 'Sajt', portion: 1, measure: Measure::G)));
    }
}
