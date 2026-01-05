<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\TemplatingProcessor;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class FoodFactoryTest extends TestCase
{
    private FoodFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new FoodFactory(
            __DIR__ . '/../../../app/foods.yaml',
            $this->createMock(ThumbnailFactory::class),
            $templatingProcessor = $this->createMock(TemplatingProcessor::class),
        );

        $templatingProcessor
            ->expects(self::any())
            ->method('process')
            ->willReturnCallback(fn(Food $value, array $data) => []);
    }

    #[Test]
    public function testCreateFood(): void
    {
        $food = $this->sut->createFood(
            foodName   : 'Bolognai',
            ingredients: [
                new IngredientForFood(name: 'meat', category: 'meat-category', portion: 1, measure: Measure::KG),
                new IngredientForFood(name: 'pasta', category: 'pasta-category', portion: 1, measure: Measure::KG),
            ],
            portion    : 6
        );

        $this->assertEquals('Bolognai', $food->name());
        $this->assertEquals(4, $food->defaultPortion());
        $this->assertEquals(
            [
                new IngredientForFood(name: 'meat', category: 'meat-category', portion: 1.5, measure: Measure::KG),
                new IngredientForFood(name: 'pasta', category: 'pasta-category', portion: 1.5, measure: Measure::KG),
            ],
            $food->ingredients()
        );
    }

    #[Test]
    public function testCreateFoodWithoutPortion(): void
    {
        $food = $this->sut->createFood(
            foodName   : 'Bolognai',
            ingredients: [
                new IngredientForFood(name: 'meat', category: 'meat-category', portion: 1, measure: Measure::KG),
                new IngredientForFood(name: 'pasta', category: 'pasta-category', portion: 1, measure: Measure::KG),
            ]
        );

        $this->assertEquals('Bolognai', $food->name());
        $this->assertEquals(4, $food->defaultPortion());
        $this->assertEquals(
            [
                new IngredientForFood(name: 'meat', category: 'meat-category', portion: 1, measure: Measure::KG),
                new IngredientForFood(name: 'pasta', category: 'pasta-category', portion: 1, measure: Measure::KG),
            ],
            $food->ingredients()
        );
    }
}
