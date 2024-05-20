<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrierKategoria;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrierKategoriaMap;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class KauflandTrierKategoriaMapTest extends TestCase
{
    #[Test]
    #[DataProvider('kategoriaMapDataProvider')]
    public function testMap(Kategoria $from, Kategoria $to): void
    {
        $map = new KauflandTrierKategoriaMap();

        $this->assertEquals($to->value(), $map->map($from)->value());
    }

    public static function kategoriaMapDataProvider(): array
    {
        return [
            [
                HozzavaloKategoria::ZOLDSEG,
                KauflandTrierKategoria::ZOLDSEG,
            ],
            [
                HozzavaloKategoria::OLAJ,
                KauflandTrierKategoria::FUSZER_ES_OLAJ,
            ],
            [
                HozzavaloKategoria::FUSZER,
                KauflandTrierKategoria::FUSZER_ES_OLAJ,
            ],
            [
                HozzavaloKategoria::BOR,
                KauflandTrierKategoria::HOSSZU_SOROK,
            ],
            [
                HozzavaloKategoria::PEKARU,
                KauflandTrierKategoria::HOSSZU_SOROK,
            ],
            [
                HozzavaloKategoria::TARTOS_ELELMISZER,
                KauflandTrierKategoria::HOSSZU_SOROK,
            ],
            [
                HozzavaloKategoria::FELVAGOTT,
                KauflandTrierKategoria::HUS,
            ],
            [
                HozzavaloKategoria::HUS,
                KauflandTrierKategoria::HUS,
            ],
            [
                HozzavaloKategoria::MIRELIT,
                KauflandTrierKategoria::HUTOS,
            ],
            [
                HozzavaloKategoria::TEJTERMEK,
                KauflandTrierKategoria::HUTOS,
            ],
            [
                HozzavaloKategoria::TARTOS_TEJTERMEK,
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                HozzavaloKategoria::HUTOS_UTAN,
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                HozzavaloKategoria::AZSIAI,
                KauflandTrierKategoria::HUTOS_UTAN,
            ],
            [
                HozzavaloKategoria::UDITOK,
                KauflandTrierKategoria::UDITOK,
            ],
        ];
    }
}
