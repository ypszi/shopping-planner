<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket;

use Override;
use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\Ecet\Ecet;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavalokByKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\ShoppingList\ShoppingList;
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
        $this->testFood = new class() extends Etel {
            #[Override] public static function name(): string
            {
                return 'test food';
            }

            #[Override] protected function listHozzavalok(): array
            {
                return [
                    new Tojas(1, Mertekegyseg::DB),
                    new Ecet(1, Mertekegyseg::L),
                ];
            }

            #[Override] public static function defaultAdag(): int
            {
                return 1;
            }

            #[Override] public function receptUrl(): string
            {
                return 'https://online-recept-konyv.hu/test-food';
            }
        };

        $this->supermarket = new class(
            $this->kategoriaMap = $this->createMock(KategoriaMap::class),
            $this->hozzavaloToKategoriaMap = $this->createMock(HozzavaloToKategoriaMap::class),
        ) extends Supermarket {
            #[Override] public static function name(): string
            {
                return 'test supermarket';
            }

            #[Override] public static function sorrend(): array
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
        $hozzavalokByKategoria = new HozzavalokByKategoria();

        foreach (new Etelek([$this->testFood]) as $etel) {
            $hozzavalokByKategoria->addMultipleHozzavalo($etel->hozzavalok());
        }

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

        $shoppingList = $this->supermarket->toShoppingList($hozzavalokByKategoria);

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
}
