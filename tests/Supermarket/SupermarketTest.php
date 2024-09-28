<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket;

use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\ShoppingList\ShoppingList;
use PeterPecosz\Kajatervezo\ShoppingList\ShoppingListByFood;
use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SupermarketTest extends TestCase
{
    private Etel $testFood;

    private KategoriaMap&MockObject $kategoriaMap;

    private HozzavaloToKategoriaMap&MockObject $hozzavaloToKategoriaMap;

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
                                new Hozzavalo('Tojás', 1, Mertekegyseg::DB, HozzavaloKategoria::TEJTERMEK),
                                new Hozzavalo('Ecet', 1, Mertekegyseg::L, HozzavaloKategoria::ECET),
                            ]
        );

        $this->supermarket = new class(
            $this->kategoriaMap = $this->createMock(KategoriaMap::class),
            $this->hozzavaloToKategoriaMap = $this->createMock(HozzavaloToKategoriaMap::class),
        ) extends Supermarket {
            public static function name(): string
            {
                return 'test supermarket';
            }

            public static function sorrend(): array
            {
                return [
                    HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value,
                    HozzavaloKategoria::ECET->value,
                    HozzavaloKategoria::OLAJ->value,
                    HozzavaloKategoria::TEJTERMEK->value,
                    HozzavaloKategoria::TARTOS_TEJTERMEK->value,
                ];
            }
        };
    }

    #[Test]
    public function testToShoppingList(): void
    {
        $this->kategoriaMap
            ->expects(self::exactly(2))
            ->method('map')
            ->willReturnOnConsecutiveCalls(
                HozzavaloKategoria::TEJTERMEK,
                HozzavaloKategoria::ECET,
            );

        $this->hozzavaloToKategoriaMap
            ->expects(self::exactly(2))
            ->method('map')
            ->willReturnOnConsecutiveCalls(
                HozzavaloKategoria::TEJTERMEK,
                HozzavaloKategoria::ECET,
            );

        $shoppingList = $this->supermarket->toShoppingList(new Etelek([$this->testFood]));

        $this->assertEquals(
            new ShoppingList(
                [
                    HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value,
                    HozzavaloKategoria::ECET->value,
                    HozzavaloKategoria::OLAJ->value,
                    HozzavaloKategoria::TEJTERMEK->value,
                    HozzavaloKategoria::TARTOS_TEJTERMEK->value,
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
        $this->kategoriaMap
            ->expects(self::exactly(2))
            ->method('map')
            ->willReturnOnConsecutiveCalls(
                HozzavaloKategoria::TEJTERMEK,
                HozzavaloKategoria::ECET,
            );

        $this->hozzavaloToKategoriaMap
            ->expects(self::exactly(2))
            ->method('map')
            ->willReturnOnConsecutiveCalls(
                HozzavaloKategoria::TEJTERMEK,
                HozzavaloKategoria::ECET,
            );

        $shoppingList = $this->supermarket->toShoppingListByFood(new Etelek([$this->testFood]));

        $this->assertEquals(
            new ShoppingListByFood(
                [
                    HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value,
                    HozzavaloKategoria::ECET->value,
                    HozzavaloKategoria::OLAJ->value,
                    HozzavaloKategoria::TEJTERMEK->value,
                    HozzavaloKategoria::TARTOS_TEJTERMEK->value,
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
