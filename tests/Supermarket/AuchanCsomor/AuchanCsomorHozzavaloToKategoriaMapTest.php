<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\AuchanCsomor;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomorHozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomorKategoria;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AuchanCsomorHozzavaloToKategoriaMapTest extends TestCase
{
    #[Test]
    #[DataProvider('hozzavaloTokategoriaMapDataProvider')]
    public function testMap(Hozzavalo $from, Kategoria $to): void
    {
        $map = new AuchanCsomorHozzavaloToKategoriaMap();

        $this->assertEquals($to->value(), $map->map($from)->value());
    }

    public static function hozzavaloTokategoriaMapDataProvider(): array
    {
        return [
            [
                new Hozzavalo(
                    name:         'Élesztő',
                    mennyiseg:    1,
                    mertekegyseg: Mertekegyseg::G,
                    kategoria:    HozzavaloKategoria::TARTOS_ELELMISZER,
                ),
                AuchanCsomorKategoria::TEJTERMEK,
            ],
            [
                new Hozzavalo(
                    name:         'Finomliszt',
                    mennyiseg:    1,
                    mertekegyseg: Mertekegyseg::G,
                    kategoria:    HozzavaloKategoria::TARTOS_ELELMISZER,
                ),
                AuchanCsomorKategoria::SUTEMENY,
            ],
            [
                new Hozzavalo(
                    name:         'Csirkemell',
                    mennyiseg:    1,
                    mertekegyseg: Mertekegyseg::KG,
                    kategoria:    HozzavaloKategoria::HUS,
                ),
                HozzavaloKategoria::HUS,
            ],
        ];
    }
}
