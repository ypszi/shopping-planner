<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Supermarket;

use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\Foods;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use PeterPecosz\ShoppingPlanner\ShoppingList\ShoppingList;
use PeterPecosz\ShoppingPlanner\ShoppingList\ShoppingListByFood;
use PeterPecosz\ShoppingPlanner\Supermarket\CategoryMap;
use PeterPecosz\ShoppingPlanner\Supermarket\IngredientToCategoryMap;
use PeterPecosz\ShoppingPlanner\Supermarket\Supermarket;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SupermarketTest extends TestCase
{
    private Food $testFood;

    private CategoryMap&MockObject $categoryMap;

    private IngredientToCategoryMap&MockObject $ingredientToCategoryMap;

    private Supermarket $supermarket;

    protected function setUp(): void
    {
        $this->testFood = new Food(
            name:           'test food',
            defaultPortion: 1,
            portion:        null,
            recipeUrl:      'https://online-recept-konyv.hu/test-food',
            thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
            comments:       [],
            ingredients:    [
                                new IngredientForFood(name: 'Tojás', category: 'Tejtermék', portion: 1, measure: Measure::DB),
                                new IngredientForFood(name: 'Ecet', category: 'Ecet', portion: 1, measure: Measure::L),
                            ]
        );

        $this->supermarket = new Supermarket(
            name:                    'test supermarket',
            categories:              [
                                         'Zöldség / Gyümölcs',
                                         'Ecet',
                                         'Olaj',
                                         'Tejtermék',
                                         'Tartós tejtermék',
                                     ],
            categoryMap:             $this->categoryMap = $this->createMock(CategoryMap::class),
            ingredientToCategoryMap: $this->ingredientToCategoryMap = $this->createMock(IngredientToCategoryMap::class),
        );
    }

    #[Test]
    public function testToShoppingList(): void
    {
        $this->categoryMap
            ->expects(self::exactly(2))
            ->method('map')
            ->willReturnOnConsecutiveCalls(
                'Tejtermék',
                'Ecet',
            );

        $this->ingredientToCategoryMap
            ->expects(self::exactly(2))
            ->method('map')
            ->willReturnOnConsecutiveCalls(
                'Tejtermék',
                'Ecet',
            );

        $shoppingList = $this->supermarket->toShoppingList(new Foods([$this->testFood]));

        $this->assertEquals(
            new ShoppingList(
                [
                    'Zöldség / Gyümölcs',
                    'Ecet',
                    'Olaj',
                    'Tejtermék',
                    'Tartós tejtermék',
                ],
                [
                    [
                        '',
                        '1.00 l Ecet',
                        '',
                        '1.00 db Tojás',
                        '',
                    ],
                ]
            ),
            $shoppingList
        );
    }

    #[Test]
    public function testToShoppingListByFood(): void
    {
        $this->categoryMap
            ->expects(self::exactly(2))
            ->method('map')
            ->willReturnOnConsecutiveCalls(
                'Tejtermék',
                'Ecet',
            );

        $this->ingredientToCategoryMap
            ->expects(self::exactly(2))
            ->method('map')
            ->willReturnOnConsecutiveCalls(
                'Tejtermék',
                'Ecet',
            );

        $shoppingList = $this->supermarket->toShoppingListByFood(new Foods([$this->testFood]));

        $this->assertEquals(
            new ShoppingListByFood(
                [
                    'Zöldség / Gyümölcs',
                    'Ecet',
                    'Olaj',
                    'Tejtermék',
                    'Tartós tejtermék',
                ],
                [
                    $this->testFood->name() => [
                        [
                            '',
                            '1.00 l Ecet',
                            '',
                            '1.00 db Tojás',
                            '',
                        ],
                    ],
                ]
            ),
            $shoppingList
        );
    }
}
