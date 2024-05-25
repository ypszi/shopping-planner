<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\AuchanLuxembourg;

use Override;
use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\Ecet\Ecet;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavalokByKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\TonhalKonzerv;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\FetaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourg;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AuchanLuxembourgTest extends TestCase
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

            #[Override] protected function listHozzavalok(): array
            {
                return [
                    new Tojas(1, Mertekegyseg::DB),
                    new Ecet(1, Mertekegyseg::L),
                    new TonhalKonzerv(100, Mertekegyseg::G),
                    new FetaSajt(200, Mertekegyseg::G),
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

        $this->supermarket = new AuchanLuxembourg();
    }

    #[Test]
    public function testName(): void
    {
        $this->assertEquals('Auchan - Luxembourg', $this->supermarket::name());
    }

    #[Test]
    public function testSorrend(): void
    {
        $this->assertEquals(
            [
                'Üditő',
                'Konzerv, Szósz, Olaj, Ecet, Fűszer',
                'Tészta, Rizs, Paradicsomszósz, Puré',
                'Tea, Kávé',
                'Cukrász, Keksz',
                'Nemzetközi',
                'Mirelit',
                'Sajt',
                'Tartós tejtermék',
                'Tejtermék',
                'Hús',
                'Felvágott',
                'Joghurt',
                'Zöldség / Gyümölcs',
                'Hal',
                'Pékárú',
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
                    '',
                    '1.00 l Ecet',
                    '',
                    '',
                    '',
                    '100.00 g Tonhal konzerv',
                    '',
                    '200.00 g Feta sajt',
                    '1.00 db Tojás',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                ],
            ],
            $shoppingList
        );
    }
}
