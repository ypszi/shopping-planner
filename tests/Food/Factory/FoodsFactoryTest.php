<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodsFactory;
use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\Foods;
use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FoodsFactoryTest extends TestCase
{
    private FoodFactory&MockObject $foodFactory;

    private IngredientFactory&MockObject $ingredientFactory;

    private FoodsFactory $sut;

    protected function setUp(): void
    {
        $this->foodFactory       = $this->createMock(FoodFactory::class);
        $this->ingredientFactory = $this->createMock(IngredientFactory::class);

        $this->sut = new FoodsFactory(
            $this->foodFactory,
            $this->ingredientFactory,
            __DIR__ . '/../../../app/foods.yaml',
        );
    }

    #[Test]
    public function testCreate(): void
    {
        $expectedFoodName   = 'Alpesi Sajtos Tészta (Älplermagronen)';
        $expectedIngredient = $this->createMock(IngredientForFood::class);
        $ingredientCount    = 10;
        $expectedFood       = $this->createMock(Food::class);

        $this->ingredientFactory
            ->expects(self::exactly($ingredientCount))
            ->method('forFood')
            ->willReturnCallback(
                fn(string $foodName, array $ingredient) => match ([$foodName, $ingredient]) {
                    [
                        $expectedFoodName,
                        ['name' => 'Burgonya', 'portion' => '40 dkg'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Só', 'portion' => '1 tk'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Makaróni tészta', 'portion' => '25 dkg'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Gouda sajt', 'portion' => '20 dkg'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Tej', 'portion' => '1.5 dl'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Tejszín', 'portion' => '1 dl'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Bors', 'portion' => '1 csipet'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Vöröshagyma', 'portion' => '2 db'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Olívaolaj', 'portion' => '2 ek'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Petrezselyem', 'portion' => '1 ek'],
                    ]       => $expectedIngredient,
                    default => $this->fail(sprintf('Unexpected food: "%s" or ingredient: "%s"', $foodName, json_encode($ingredient)))
                }
            );

        $this->foodFactory
            ->expects(self::once())
            ->method('createFood')
            ->with(
                $expectedFoodName,
                array_fill(0, $ingredientCount, $expectedIngredient),
                8
            )
            ->willReturn($expectedFood);

        $food = $this->sut->create([$expectedFoodName => 8]);

        $expectedFoods = (new Foods())->add($expectedFood);

        $this->assertEquals($expectedFoods, $food);
    }

    #[Test]
    public function testCreateWithReference(): void
    {
        $expectedFoodName    = 'Pizza';
        $expectedRefFoodName = 'Pizzatészta';
        $expectedIngredient  = $this->createMock(IngredientForFood::class);
        $ingredientCount     = 10;
        $expectedFood        = $this->createMock(Food::class);
        $expectedRefFood     = $this->createMock(Food::class);

        $this->ingredientFactory
            ->expects(self::exactly($ingredientCount))
            ->method('forFood')
            ->willReturnCallback(
                fn(string $foodName, array $ingredient) => match ([$foodName, $ingredient]) {
                    [
                        $expectedFoodName,
                        ['name' => 'Paradicsom püré', 'portion' => '100 g'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Felvágott', 'portion' => '15 dkg'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Mozzarella sajt (reszelt)', 'portion' => '150 g'],
                    ],
                    [
                        $expectedFoodName,
                        ['name' => 'Ketchup', 'portion' => '50 g'],
                    ],
                    [
                        $expectedRefFoodName,
                        ['name' => 'Finomliszt', 'portion' => '500 g'],
                    ],
                    [
                        $expectedRefFoodName,
                        ['name' => 'Só', 'portion' => '0.5 ek'],
                    ],
                    [
                        $expectedRefFoodName,
                        ['name' => 'Cukor', 'portion' => '0.5 ek'],
                    ],
                    [
                        $expectedRefFoodName,
                        ['name' => 'Olívaolaj', 'portion' => '2 ek'],
                    ],
                    [
                        $expectedRefFoodName,
                        ['name' => 'Víz', 'portion' => '325 ml'],
                    ],
                    [
                        $expectedRefFoodName,
                        ['name' => 'Élesztő', 'portion' => '7 g'],
                    ]       => $expectedIngredient,
                    default => $this->fail(sprintf('Unexpected food: "%s" or ingredient: "%s"', $foodName, json_encode($ingredient)))
                }
            );

        $this->foodFactory
            ->expects(self::exactly(2))
            ->method('createFood')
            ->willReturnCallback(
                fn(string $foodName, array $ingredients, ?int $portion) => match ([$foodName, $ingredients, $portion]) {
                    [
                        $expectedFoodName,
                        array_fill(0, 4, $expectedIngredient),
                        8,
                    ]       => $expectedFood,
                    [
                        $expectedRefFoodName,
                        array_fill(0, 6, $expectedIngredient),
                        null,
                    ]       => $expectedRefFood,
                    default => $this->fail(sprintf('Unexpected food: "%s", ingredients: "%s" or portion: "%s"', $foodName, json_encode($ingredients), $portion))
                },
            );;

        $food = $this->sut->create([$expectedFoodName => 8]);

        $expectedFoods = (new Foods())->add($expectedFood);

        $this->assertEquals($expectedFoods, $food);
    }
}
