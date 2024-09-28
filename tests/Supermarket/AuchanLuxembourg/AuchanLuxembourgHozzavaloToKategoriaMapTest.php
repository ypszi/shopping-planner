<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\AuchanLuxembourg;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourgHozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourgKategoria;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AuchanLuxembourgHozzavaloToKategoriaMapTest extends TestCase
{
    #[Test]
    #[DataProvider('hozzavaloTokategoriaMapDataProvider')]
    public function testMap(Hozzavalo $from, Kategoria $to): void
    {
        $map = new AuchanLuxembourgHozzavaloToKategoriaMap();

        $this->assertEquals($to->value(), $map->map($from)->value());
    }

    public static function hozzavaloTokategoriaMapDataProvider(): array
    {
        return [
            [
                new Hozzavalo(
                    name:         'Tojás',
                    mennyiseg:    1,
                    mertekegyseg: Mertekegyseg::DB,
                    kategoria:    HozzavaloKategoria::TEJTERMEK,
                ),
                AuchanLuxembourgKategoria::TARTOS_TEJTERMEK,
            ],
            [
                new Hozzavalo(
                    name:         'Tonhal (konzerv)',
                    mennyiseg:    1,
                    mertekegyseg: Mertekegyseg::G,
                    kategoria:    HozzavaloKategoria::TARTOS_ELELMISZER,
                ),
                AuchanLuxembourgKategoria::NEMZETKOZI,
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
