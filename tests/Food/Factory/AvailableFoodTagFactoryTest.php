<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\CookingSteps\CookingStepsProcessor;
use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodTagFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Food\Food;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AvailableFoodTagFactoryTest extends TestCase
{
    private const FOODS_PATH = __DIR__ . '/../../../app/foods.yaml';

    private AvailableFoodTagFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new AvailableFoodTagFactory(
            foodFactory: new FoodFactory(
                self::FOODS_PATH,
                $this->createMock(ThumbnailFactory::class),
                $cookingStepsProcessor = $this->createMock(CookingStepsProcessor::class)
            ),
            foodsPath  : self::FOODS_PATH
        );

        $cookingStepsProcessor
            ->expects(self::any())
            ->method('process')
            ->willReturnCallback(fn (Food $value) => $value);
    }

    #[Test]
    public function testListAvailableFoodTags(): void
    {
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
}
