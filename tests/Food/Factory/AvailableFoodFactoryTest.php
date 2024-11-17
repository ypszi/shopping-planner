<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AvailableFoodFactoryTest extends TestCase
{
    private FoodFactory&MockObject $foodFactory;

    private IngredientFactory&MockObject $ingredientFactory;

    private AvailableFoodFactory $sut;

    protected function setUp(): void
    {
        $this->foodFactory       = $this->createMock(FoodFactory::class);
        $this->ingredientFactory = $this->createMock(IngredientFactory::class);

        $this->sut = new AvailableFoodFactory(
            foodFactory:       $this->foodFactory,
            ingredientFactory: $this->ingredientFactory,
            foodsPath:         __DIR__ . '/../../../app/foods.yaml'
        );
    }

    #[Test]
    public function testListAvailableFoods(): void
    {
        $this->assertCount(83, $this->sut->listAvailableFoods());
    }
}
