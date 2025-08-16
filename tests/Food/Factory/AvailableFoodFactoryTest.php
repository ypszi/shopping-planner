<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\CookingSteps\CookingStepsProcessor;
use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Shopping\Input\FoodFilterInput;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AvailableFoodFactoryTest extends TestCase
{
    private const FOODS_PATH = __DIR__ . '/../../../app/foods.yaml';

    private AvailableFoodFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new AvailableFoodFactory(
            foodFactory      : new FoodFactory(
                self::FOODS_PATH,
                $this->createMock(ThumbnailFactory::class),
                $cookingStepsProcessor = $this->createMock(CookingStepsProcessor::class)
            ),
            ingredientFactory: $this->createMock(IngredientFactory::class),
            foodsPath        : self::FOODS_PATH
        );

        $cookingStepsProcessor
            ->expects(self::any())
            ->method('process')
            ->willReturnCallback(fn (Food $value) => $value);
    }

    #[Test]
    public function testListAvailableFoods(): void
    {
        $this->assertCount(130, $this->sut->listAvailableFoods(new FoodFilterInput()));
    }

    #[Test]
    #[DataProvider('foodTagDataProvider')]
    public function testListAvailableFoodsFilteredForTags(array $tags, int $expectedCount): void
    {
        $this->assertCount(
            $expectedCount,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: $tags)),
            sprintf('Expectation failed for tags: "%s"', json_encode($tags))
        );
    }

    public static function foodTagDataProvider(): array
    {
        return [
            'reggeli'  => ['tags' => ['reggeli'], 'expectedCount' => 3],
            'ebéd'     => ['tags' => ['ebéd'], 'expectedCount' => 66],
            'vacsora'  => ['tags' => ['vacsora'], 'expectedCount' => 32],
            'köret'    => ['tags' => ['köret'], 'expectedCount' => 20],
            'leves'    => ['tags' => ['leves'], 'expectedCount' => 4],
            'saláta'   => ['tags' => ['saláta'], 'expectedCount' => 22],
            'desszert' => ['tags' => ['desszert'], 'expectedCount' => 20],
            'új'       => ['tags' => ['új'], 'expectedCount' => 9],
            'suli'     => ['tags' => ['suli'], 'expectedCount' => 5],
            'ital'     => ['tags' => ['ital'], 'expectedCount' => 1],
        ];
    }

    #[Test]
    public function testListAvailableFoodsFilteredForMultipleTags(): void
    {
        $this->assertCount(
            73,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: ['reggeli', 'ebéd', 'vacsora'])),
            'Expectation failed for tags: "reggeli, ebéd, vacsora"'
        );
    }
}
