<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\AuchanCsomor;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomorKategoria;
use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomorKategoriaMap;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AuchanCsomorKategoriaMapTest extends TestCase
{
    #[Test]
    #[DataProvider('kategoriaMapDataProvider')]
    public function testMap(Kategoria $from, Kategoria $to): void
    {
        $map = new AuchanCsomorKategoriaMap();

        $this->assertEquals($to->value(), $map->map($from)->value());
    }

    public static function kategoriaMapDataProvider(): array
    {
        return [
            [
                HozzavaloKategoria::UDITO,
                AuchanCsomorKategoria::UDITO,
            ],
            [
                HozzavaloKategoria::BOR,
                AuchanCsomorKategoria::UDITO,
            ],
            [
                HozzavaloKategoria::OLAJ,
                AuchanCsomorKategoria::OLAJ_ECET,
            ],
            [
                HozzavaloKategoria::ECET,
                AuchanCsomorKategoria::OLAJ_ECET,
            ],
            [
                HozzavaloKategoria::FUSZER,
                AuchanCsomorKategoria::FUSZER,
            ],
            [
                HozzavaloKategoria::TARTOS_ELELMISZER,
                AuchanCsomorKategoria::TESZTA_RIZS,
            ],
            [
                HozzavaloKategoria::CUKRASZ,
                AuchanCsomorKategoria::SUTEMENY,
            ],
            [
                HozzavaloKategoria::AZSIAI,
                AuchanCsomorKategoria::NEMZETKOZI,
            ],
            [
                HozzavaloKategoria::MIRELIT,
                AuchanCsomorKategoria::MIRELIT,
            ],
            [
                HozzavaloKategoria::SAJT,
                AuchanCsomorKategoria::TEJTERMEK,
            ],
            [
                HozzavaloKategoria::TARTOS_TEJTERMEK,
                AuchanCsomorKategoria::TARTOS_TEJTERMEK,
            ],
            [
                HozzavaloKategoria::TEJTERMEK,
                AuchanCsomorKategoria::TEJTERMEK,
            ],
            [
                HozzavaloKategoria::HUS,
                AuchanCsomorKategoria::HUS,
            ],
            [
                HozzavaloKategoria::FELVAGOTT,
                AuchanCsomorKategoria::FELVAGOTT,
            ],
            [
                HozzavaloKategoria::ZOLDSEG_GYUMOLCS,
                AuchanCsomorKategoria::ZOLDSEG_GYUMOLCS,
            ],
            [
                HozzavaloKategoria::HAL,
                AuchanCsomorKategoria::HAL,
            ],
            [
                HozzavaloKategoria::PEKARU,
                AuchanCsomorKategoria::PEKARU,
            ],
        ];
    }
}
