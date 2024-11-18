<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodTagFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AvailableFoodTagFactoryTest extends TestCase
{
    private const FOODS_PATH = __DIR__ . '/../../../app/foods.yaml';

    private AvailableFoodTagFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new AvailableFoodTagFactory(
            foodFactory: new FoodFactory(self::FOODS_PATH),
            foodsPath:   self::FOODS_PATH
        );
    }

    #[Test]
    public function testListAvailableFoodTags(): void
    {
        $this->assertEquals(
            [
                'ebéd',
                'köret',
                'saláta',
                'vacsora',
                'új',
            ],
            $this->sut->listAvailableFoodTags()
        );
    }
}
