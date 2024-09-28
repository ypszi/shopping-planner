<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
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
                new Ketchup(1, Mertekegyseg::G),
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                new Majonez(1, Mertekegyseg::L),
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                new Mustar(1, Mertekegyseg::L),
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                new Vaj(1, Mertekegyseg::L),
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                new Csirkemell(1, Mertekegyseg::KG),
                (new Csirkemell(1, Mertekegyseg::KG))->kategoria(),
            ],
        ];
    }
}
