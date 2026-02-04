<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Integration\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\TemplatingProcessor;
use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Shopping\Input\FoodFilterInput;
use PeterPecosz\ShoppingPlanner\Tests\Support\AvailableCount;
use PeterPecosz\ShoppingPlanner\Tests\Support\Resource;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AvailableFoodFactoryTest extends TestCase
{
    private const FOODS_PATH = Resource::Foods->value;

    private ThumbnailFactory&MockObject $thumbnailFactory;

    private TemplatingProcessor&MockObject $templatingProcessor;

    private IngredientFactory&MockObject $ingredientFactory;

    private AvailableFoodFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new AvailableFoodFactory(
            foodFactory      : new FoodFactory(
                self::FOODS_PATH,
                $this->thumbnailFactory = $this->createMock(ThumbnailFactory::class),
                $this->templatingProcessor = $this->createMock(TemplatingProcessor::class),
            ),
            ingredientFactory: $this->ingredientFactory = $this->createMock(IngredientFactory::class),
            foodsPath        : self::FOODS_PATH
        );
    }

    #[Test]
    public function testListAvailableFoods(): void
    {
        $this->ingredientFactory
            ->expects($this->atLeast(AvailableCount::getFoodCount()))
            ->method('forFood');

        $this->thumbnailFactory
            ->expects($this->atLeast(AvailableCount::getFoodCount()))
            ->method('create')
            ->with($this->isInstanceOf(Food::class));

        $this->mockTemplatingProcessor();

        $this->assertCount(AvailableCount::getFoodCount(), $this->sut->listAvailableFoods(new FoodFilterInput()));
    }

    #[Test]
    #[DataProvider('foodTagDataProvider')]
    public function testListAvailableFoodsFilteredForTags(array $tags, int $expectedCount): void
    {
        $this->ingredientFactory
            ->expects($this->atLeast(AvailableCount::getFoodCount()))
            ->method('forFood');

        $this->thumbnailFactory
            ->expects($this->atLeast(AvailableCount::getFoodCount()))
            ->method('create')
            ->with($this->isInstanceOf(Food::class));

        $this->mockTemplatingProcessor();

        $this->assertCount(
            $expectedCount,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: $tags)),
            sprintf('Expectation failed for tags: "%s"', json_encode($tags))
        );
    }

    public static function foodTagDataProvider(): array
    {
        return [
            'reggeli'  => ['tags' => ['reggeli'], 'expectedCount' => 4],
            'ebéd'     => ['tags' => ['ebéd'], 'expectedCount' => 69],
            'vacsora'  => ['tags' => ['vacsora'], 'expectedCount' => 36],
            'köret'    => ['tags' => ['köret'], 'expectedCount' => 23],
            'leves'    => ['tags' => ['leves'], 'expectedCount' => 4],
            'saláta'   => ['tags' => ['saláta'], 'expectedCount' => 25],
            'desszert' => ['tags' => ['desszert'], 'expectedCount' => 21],
            'új'       => ['tags' => ['új'], 'expectedCount' => 9],
            'suli'     => ['tags' => ['suli'], 'expectedCount' => 5],
            'ital'     => ['tags' => ['ital'], 'expectedCount' => 1],
        ];
    }

    #[Test]
    public function testListAvailableFoodsFilteredForMultipleTags(): void
    {
        $this->ingredientFactory
            ->expects($this->atLeast(AvailableCount::getFoodCount()))
            ->method('forFood');

        $this->thumbnailFactory
            ->expects($this->atLeast(AvailableCount::getFoodCount()))
            ->method('create')
            ->with($this->isInstanceOf(Food::class));

        $this->mockTemplatingProcessor();

        $this->assertCount(
            77,
            $this->sut->listAvailableFoods(new FoodFilterInput(tags: ['reggeli', 'ebéd', 'vacsora'])),
            'Expectation failed for tags: "reggeli, ebéd, vacsora"'
        );
    }

    private function mockTemplatingProcessor(): void
    {
        // call is done 2x for each food due to comments, cookingSteps
        $this->templatingProcessor
            ->expects($this->atLeast(AvailableCount::getFoodCount()))
            ->method('process')
            ->with($this->isInstanceOf(Food::class))
            ->willReturnCallback(fn(Food $value, array $data) => []);
    }
}
