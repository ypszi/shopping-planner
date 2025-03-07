<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food;

use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\Foods;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class FoodsTest extends TestCase
{
    private Food $testFood;

    protected function setUp(): void
    {
        $this->testFood = new Food(
            name:           'test food',
            defaultPortion: 1,
            portion:        null,
            recipeUrl:      'https://online-recept-konyv.hu/test-food',
            thumbnailUrl:   null,
            comments:       [],
            ingredients:    [
                                new IngredientForFood(
                                    name:     'Tojás',
                                    category: 'Tejtermék',
                                    portion:  1,
                                    measure:  Measure::DB
                                ),
                            ]
        );
    }

    #[Test]
    public function testAdd(): void
    {
        $sut = new Foods();
        $sut->add($this->testFood);

        $this->assertEquals(new Foods([$this->testFood]), $sut);
    }

    #[Test]
    public function testToArray(): void
    {
        $this->assertEquals([$this->testFood], (new Foods([$this->testFood]))->toArray());
    }
}
