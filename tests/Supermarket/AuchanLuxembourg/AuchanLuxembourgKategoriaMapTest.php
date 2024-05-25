<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\AuchanLuxembourg;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourgKategoria;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourgKategoriaMap;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AuchanLuxembourgKategoriaMapTest extends TestCase
{
    #[Test]
    #[DataProvider('kategoriaMapDataProvider')]
    public function testMap(Kategoria $from, Kategoria $to): void
    {
        $map = new AuchanLuxembourgKategoriaMap();

        $this->assertEquals($to->value(), $map->map($from)->value());
    }

    public static function kategoriaMapDataProvider(): array
    {
        return [
            [
                HozzavaloKategoria::ZOLDSEG_GYUMOLCS,
                AuchanLuxembourgKategoria::ZOLDSEG_GYUMOLCS,
            ],
            [
                HozzavaloKategoria::OLAJ,
                AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER,
            ],
            [
                HozzavaloKategoria::ECET,
                AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER,
            ],
            [
                HozzavaloKategoria::FUSZER,
                AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER,
            ],
            [
                HozzavaloKategoria::BOR,
                AuchanLuxembourgKategoria::UDITO,
            ],
            [
                HozzavaloKategoria::PEKARU,
                AuchanLuxembourgKategoria::PEKARU,
            ],
            [
                HozzavaloKategoria::TARTOS_ELELMISZER,
                AuchanLuxembourgKategoria::TESZTA_RIZS_PARADICSOMSZOSZ_PURE,
            ],
            [
                HozzavaloKategoria::CUKRASZ,
                AuchanLuxembourgKategoria::CUKRASZ_KEKSZ,
            ],
            [
                HozzavaloKategoria::FELVAGOTT,
                AuchanLuxembourgKategoria::FELVAGOTT,
            ],
            [
                HozzavaloKategoria::HUS,
                AuchanLuxembourgKategoria::HUS,
            ],
            [
                HozzavaloKategoria::MIRELIT,
                AuchanLuxembourgKategoria::MIRELIT,
            ],
            [
                HozzavaloKategoria::TEJTERMEK,
                AuchanLuxembourgKategoria::TEJTERMEK,
            ],
            [
                HozzavaloKategoria::TARTOS_TEJTERMEK,
                AuchanLuxembourgKategoria::TARTOS_TEJTERMEK,
            ],
            [
                HozzavaloKategoria::AZSIAI,
                AuchanLuxembourgKategoria::NEMZETKOZI,
            ],
            [
                HozzavaloKategoria::UDITO,
                AuchanLuxembourgKategoria::UDITO,
            ],
        ];
    }
}
