<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket;

use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\ShoppingList\ShoppingList;
use PeterPecosz\Kajatervezo\ShoppingList\ShoppingListByFood;
use PeterPecosz\Kajatervezo\Supermarket\CategoryMap;
use PeterPecosz\Kajatervezo\Supermarket\IngredientToCategoryMap;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SupermarketTest extends TestCase
{
    private Etel $testFood;

    private CategoryMap&MockObject $categoryMap;

    private IngredientToCategoryMap&MockObject $ingredientToCategoryMap;

    private Supermarket $supermarket;

    protected function setUp(): void
    {
        $this->testFood = new Etel(
            name:           'test food',
            defaultPortion: 1,
            adag:           null,
            receptUrl:      'https://online-recept-konyv.hu/test-food',
            thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
            comments:       null,
            ingredients:    [
                                new Hozzavalo('Tojás', 1, Mertekegyseg::DB, 'Tejtermék'),
                                new Hozzavalo('Ecet', 1, Mertekegyseg::L, 'Ecet'),
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

        $shoppingList = $this->supermarket->toShoppingList(new Etelek([$this->testFood]));

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

        $shoppingList = $this->supermarket->toShoppingListByFood(new Etelek([$this->testFood]));

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
