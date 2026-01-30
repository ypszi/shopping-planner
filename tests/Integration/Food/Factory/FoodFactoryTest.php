<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Integration\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\TemplatingProcessor;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PeterPecosz\ShoppingPlanner\Tests\Support\Resource;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FoodFactoryTest extends TestCase
{
    private ThumbnailFactory&MockObject $thumbnailFactory;

    private TemplatingProcessor&MockObject $templatingProcessor;

    private FoodFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new FoodFactory(
            Resource::Foods->value,
            $this->thumbnailFactory = $this->createMock(ThumbnailFactory::class),
            $this->templatingProcessor = $this->createMock(TemplatingProcessor::class),
        );
    }

    #[Test]
    public function testCreateFood(): void
    {
        $this->thumbnailFactory
            ->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Food::class))
            ->willReturn(null);

        $this->templatingProcessor
            ->expects($this->exactly(2))
            ->method('process')
            ->with($this->isInstanceOf(Food::class))
            ->willReturnCallback(fn(Food $value, array $data) => []);

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
        $this->thumbnailFactory
            ->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Food::class))
            ->willReturn(null);

        $this->templatingProcessor
            ->expects($this->exactly(2))
            ->method('process')
            ->with($this->isInstanceOf(Food::class))
            ->willReturnCallback(fn(Food $value, array $data) => []);

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

    public function testCreateWithThumbnail(): void
    {
        $this->thumbnailFactory
            ->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Food::class))
            ->willReturn($thumbnail = $this->createMock(Thumbnail::class));

        $thumbnail
            ->expects($this->once())
            ->method('getAssetPath')
            ->willReturn('thumbnails/Bolognai.jpg');

        $this->templatingProcessor
            ->expects($this->exactly(2))
            ->method('process')
            ->with($this->isInstanceOf(Food::class))
            ->willReturnCallback(fn(Food $value, array $data) => []);

        $food = $this->sut->createFood(
            foodName   : 'Bolognai',
            ingredients: [
                new IngredientForFood(name: 'meat', category: 'meat-category', portion: 1, measure: Measure::KG),
                new IngredientForFood(name: 'pasta', category: 'pasta-category', portion: 1, measure: Measure::KG),
            ]
        );

        $this->assertEquals('Bolognai', $food->name());
        $this->assertEquals('thumbnails/Bolognai.jpg', $food->thumbnailUrl());
    }
}
