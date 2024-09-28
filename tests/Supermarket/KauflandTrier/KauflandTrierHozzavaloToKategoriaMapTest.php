<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrierHozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrierKategoria;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class KauflandTrierHozzavaloToKategoriaMapTest extends TestCase
{
    #[Test]
    #[DataProvider('hozzavaloTokategoriaMapDataProvider')]
    public function testMap(Hozzavalo $from, Kategoria $to): void
    {
        $map = new KauflandTrierHozzavaloToKategoriaMap();

        $this->assertEquals($to->value(), $map->map($from)->value());
    }

    public static function hozzavaloTokategoriaMapDataProvider(): array
    {
        return [
            [
                new Hozzavalo('Ketchup', 1, Mertekegyseg::G, HozzavaloKategoria::TARTOS_ELELMISZER),
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                new Hozzavalo('Majonéz', 1, Mertekegyseg::L, HozzavaloKategoria::TARTOS_ELELMISZER),
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                new Hozzavalo('Mustár', 1, Mertekegyseg::L, HozzavaloKategoria::TARTOS_ELELMISZER),
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                new Hozzavalo('Vaj', 1, Mertekegyseg::L, HozzavaloKategoria::TEJTERMEK),
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::KG, HozzavaloKategoria::HUS),
                HozzavaloKategoria::HUS,
            ],
        ];
    }
}
