<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class FoodFactoryTest extends TestCase
{
    private FoodFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new FoodFactory(__DIR__ . '/../../../app/foods.yaml');
    }

    #[Test]
    public function testCreateFood(): void
    {
        $food = $this->sut->createFood(
            foodName:    'Bolognai',
            ingredients: [
                             new Ingredient('meat', 1, Measure::KG, 'meat-category'),
                             new Ingredient('pasta', 1, Measure::KG, 'pasta-category'),
                         ],
            portion:     6
        );

        $this->assertEquals('Bolognai', $food->name());
        $this->assertEquals(4, $food->defaultPortion());
        $this->assertEquals(
            [
                new Ingredient('meat', 1.5, Measure::KG, 'meat-category'),
                new Ingredient('pasta', 1.5, Measure::KG, 'pasta-category'),
            ],
            $food->ingredients()
        );
    }

    #[Test]
    public function testCreateFoodWithoutPortion(): void
    {
        $food = $this->sut->createFood(
            foodName:    'Bolognai',
            ingredients: [
                             new Ingredient('meat', 1, Measure::KG, 'meat-category'),
                             new Ingredient('pasta', 1, Measure::KG, 'pasta-category'),
                         ]
        );

        $this->assertEquals('Bolognai', $food->name());
        $this->assertEquals(4, $food->defaultPortion());
        $this->assertEquals(
            [
                new Ingredient('meat', 1, Measure::KG, 'meat-category'),
                new Ingredient('pasta', 1, Measure::KG, 'pasta-category'),
            ],
            $food->ingredients()
        );
    }
}
