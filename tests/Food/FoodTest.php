<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food;

use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class FoodTest extends TestCase
{
    private Food $testFood;

    protected function setUp(): void
    {
        $this->testFood = new Food(
            name:           'test food',
            defaultPortion: 1,
            portion:        null,
            recipeUrl:      'https://online-recept-konyv.hu/test-food',
            thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
            comments:       null,
            ingredients:    [
                                new IngredientForFood(
                                    name:     'Tojás',
                                    category: 'Tejtermék',
                                    portion:  1,
                                    measure:  Measure::DB,
                                ),
                            ]
        );
    }

    #[Test]
    public function testName(): void
    {
        $this->assertEquals('test food', $this->testFood->name());
    }

    #[Test]
    public function testRecipeUrl(): void
    {
        $this->assertEquals('https://online-recept-konyv.hu/test-food', $this->testFood->recipeUrl());
    }

    #[Test]
    public function testRecipeUrlHasNosalty(): void
    {
        $sut = new Food(
            name:           'test food',
            defaultPortion: 1,
            portion:        null,
            recipeUrl:      'https://www.nosalty.hu/recept/test-food',
            thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
            comments:       null,
            ingredients:    [
                                new IngredientForFood(
                                    name:     'Tojás',
                                    category: 'Tejtermék',
                                    portion:  1,
                                    measure:  Measure::DB,
                                ),
                            ]
        );

        $this->assertEquals('https://www.nosalty.hu/recept/test-food?adag=1', $sut->recipeUrl());
    }

    #[Test]
    public function testRecipeUrlHasNosaltyHavingQueryParam(): void
    {
        $sut = new Food(
            name:           'test food',
            defaultPortion: 1,
            portion:        null,
            recipeUrl:      'https://www.nosalty.hu/recept/test-food?query=test',
            thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
            comments:       null,
            ingredients:    [
                                new IngredientForFood(
                                    name:     'Tojás',
                                    category: 'Tejtermék',
                                    portion:  1,
                                    measure:  Measure::DB,
                                ),
                            ]
        );

        $this->assertEquals('https://www.nosalty.hu/recept/test-food?query=test&adag=1', $sut->recipeUrl());
    }

    #[Test]
    public function testRecipeUrlHasNosaltyHavingAdagQueryParam(): void
    {
        $sut = new Food(
            name:           'test food',
            defaultPortion: 1,
            portion:        null,
            recipeUrl:      'https://www.nosalty.hu/recept/test-food?adag=1',
            thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
            comments:       null,
            ingredients:    [
                                new IngredientForFood(
                                    name:     'Tojás',
                                    category: 'Tejtermék',
                                    portion:  1,
                                    measure:  Measure::DB,
                                ),
                            ]
        );

        $this->assertEquals('https://www.nosalty.hu/recept/test-food?adag=1', $sut->recipeUrl());
    }

    #[Test]
    public function testDefaultPortion(): void
    {
        $this->assertEquals(1, $this->testFood->defaultPortion());
    }

    #[Test]
    public function testWithAdag(): void
    {
        $this->assertEquals(
            new Food(
                name:           'test food',
                defaultPortion: 1,
                portion:        4,
                recipeUrl:      'https://online-recept-konyv.hu/test-food',
                thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
                comments:       null,
                ingredients:    [
                                    new IngredientForFood(
                                        name:     'Tojás',
                                        category: 'Tejtermék',
                                        portion:  1,
                                        measure:  Measure::DB,
                                    ),
                                ]
            ),
            $this->testFood->withAdag(4)
        );
    }

    #[Test]
    public function testHozzavalok(): void
    {
        $this->assertEquals(
            [
                new IngredientForFood(
                    name:     'Tojás',
                    category: 'Tejtermék',
                    portion:  1,
                    measure:  Measure::DB,
                ),
            ],
            $this->testFood->ingredients()
        );
    }

    #[Test]
    public function testThumbnailUrl(): void
    {
        $this->assertEquals('https://www.nosalty.hu/thumnails/img_5512.jpg', $this->testFood->thumbnailUrl());
    }

    #[Test]
    public function testStringify(): void
    {
        $this->assertEquals('test food (1 adag)', (string)$this->testFood);
    }
}
