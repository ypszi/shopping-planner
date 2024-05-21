<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\KauflandTrier;

use Override;
use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavalokByKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Ecet;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrier;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class KauflandTrierTest extends TestCase
{
    private Etel $testFood;

    private Supermarket $supermarket;

    protected function setUp(): void
    {
        $this->testFood = new class() extends Etel {
            #[Override] public static function name(): string
            {
                return 'test food';
            }

            #[Override] protected static function listHozzavalok(): array
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

        $this->supermarket = new KauflandTrier();
    }

    #[Test]
    public function testName(): void
    {
        $this->assertEquals('Kaufland - Trier', $this->supermarket::name());
    }

    #[Test]
    public function testSorrend(): void
    {
        $this->assertEquals(
            [
                'Zöldség',
                'Fűszer és Olaj',
                'Hosszú sorok',
                'Hús',
                'Hűtős',
                'Hűtős után',
                'Üditő',
            ],
            $this->supermarket::sorrend()
        );
    }

    #[Test]
    public function testToShoppingList(): void
    {
        $hozzavalokByKategoria = new HozzavalokByKategoria();

        foreach (new Etelek([$this->testFood]) as $etel) {
            $hozzavalokByKategoria->addMultipleHozzavalo($etel->hozzavalok());
        }

        $shoppingList = $this->supermarket->toShoppingList($hozzavalokByKategoria);

        $this->assertEquals(
            [
                [
                    '1.00 l Ecet',
                    '',
                    '',
                    '',
                    '1.00 db Tojás',
                    '',
                    '',
                ],
            ],
            $shoppingList
        );
    }
}
