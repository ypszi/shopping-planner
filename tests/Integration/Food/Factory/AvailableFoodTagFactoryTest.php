<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Integration\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodTagFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\TemplatingProcessor;
use PeterPecosz\ShoppingPlanner\Tests\Support\AvailableCount;
use PeterPecosz\ShoppingPlanner\Tests\Support\Resource;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AvailableFoodTagFactoryTest extends TestCase
{
    private ThumbnailFactory&MockObject $thumbnailFactory;

    private TemplatingProcessor&MockObject $templatingProcessor;

    private AvailableFoodTagFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new AvailableFoodTagFactory(
            foodFactory: new FoodFactory(
                Resource::Foods->value,
                $this->thumbnailFactory = $this->createMock(ThumbnailFactory::class),
                $this->templatingProcessor = $this->createMock(TemplatingProcessor::class),

            ),
            foodsPath  : Resource::Foods->value,
        );
    }

    #[Test]
    public function testListAvailableFoodTags(): void
    {
        $this->thumbnailFactory
            ->expects($this->atLeast(AvailableCount::getFoodCount()))
            ->method('create')
            ->with($this->isInstanceOf(Food::class));

        $this->mockTemplatingProcessor();

        $this->assertEquals(
            [
                'desszert',
                'ebéd',
                'ital',
                'köret',
                'leves',
                'reggeli',
                'saláta',
                'suli',
                'vacsora',
                'új',
            ],
            $this->sut->listAvailableFoodTags()
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
