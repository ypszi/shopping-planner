<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Shopping\Input\FoodFilterInput;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AvailableFoodFactoryTest extends TestCase
{
    private const FOODS_PATH = __DIR__ . '/../../../app/foods.yaml';

    private AvailableFoodFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new AvailableFoodFactory(
            foodFactory:       new FoodFactory(self::FOODS_PATH),
            ingredientFactory: $this->createMock(IngredientFactory::class),
            foodsPath:         self::FOODS_PATH
        );
    }

    #[Test]
    public function testListAvailableFoods(): void
    {
        $this->assertCount(84, $this->sut->listAvailableFoods(new FoodFilterInput()));
    }

    #[Test]
    public function testListAvailableFoodsFilteredForTags(): void
    {
        $this->assertCount(
            0,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: ['reggeli'])),
            'Expectation failed for tag: "reggeli"'
        );

        $this->assertCount(
            2,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: ['ebéd'])),
            'Expectation failed for tag: "ebéd"'
        );

        $this->assertCount(
            3,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: ['vacsora'])),
            'Expectation failed for tag: "vacsora"'
        );

        $this->assertCount(
            2,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: ['köret'])),
            'Expectation failed for tag: "köret"'
        );

        $this->assertCount(
            5,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: ['saláta'])),
            'Expectation failed for tag: "saláta"'
        );

        $this->assertCount(
            6,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: ['új'])),
            'Expectation failed for tag: "új"'
        );
    }

    #[Test]
    public function testListAvailableFoodsFilteredForMultipleTags(): void
    {
        $this->assertCount(
            4,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: ['reggeli', 'ebéd', 'vacsora'])),
            'Expectation failed for tags: "reggeli, ebéd, vacsora"'
        );
    }
}
