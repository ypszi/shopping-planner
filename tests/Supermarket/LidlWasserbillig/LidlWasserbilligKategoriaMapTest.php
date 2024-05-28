<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\LidlWasserbillig\LidlWasserbilligKategoria;
use PeterPecosz\Kajatervezo\Supermarket\LidlWasserbillig\LidlWasserbilligKategoriaMap;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class LidlWasserbilligKategoriaMapTest extends TestCase
{
    #[Test]
    #[DataProvider('kategoriaMapDataProvider')]
    public function testMap(Kategoria $from, Kategoria $to): void
    {
        $map = new LidlWasserbilligKategoriaMap();

        $this->assertEquals($to->value(), $map->map($from)->value());
    }

    public static function kategoriaMapDataProvider(): array
    {
        return [
            [
                HozzavaloKategoria::PEKARU,
                LidlWasserbilligKategoria::MUZLI_PEKARU,
            ],
            [
                HozzavaloKategoria::ZOLDSEG_GYUMOLCS,
                LidlWasserbilligKategoria::ZOLDSEG_GYUMOLCS,
            ],
            [
                HozzavaloKategoria::FELVAGOTT,
                LidlWasserbilligKategoria::FELVAGOTT,
            ],
            [
                HozzavaloKategoria::HUS,
                LidlWasserbilligKategoria::HUS,
            ],
            [
                HozzavaloKategoria::HAL,
                LidlWasserbilligKategoria::FUSZER_HAL,
            ],
            [
                HozzavaloKategoria::FUSZER,
                LidlWasserbilligKategoria::FUSZER_HAL,
            ],
            [
                HozzavaloKategoria::SAJT,
                LidlWasserbilligKategoria::SAJT,
            ],
            [
                HozzavaloKategoria::TEJTERMEK,
                LidlWasserbilligKategoria::TEJTERMEK,
            ],
            [
                HozzavaloKategoria::UDITO,
                LidlWasserbilligKategoria::UDITO,
            ],
            [
                HozzavaloKategoria::MIRELIT,
                LidlWasserbilligKategoria::MIRELIT,
            ],
            [
                HozzavaloKategoria::BOR,
                LidlWasserbilligKategoria::SOS_RAGCSA_SOR_BOR,
            ],
            [
                HozzavaloKategoria::TARTOS_TEJTERMEK,
                LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            ],
            [
                HozzavaloKategoria::TARTOS_ELELMISZER,
                LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            ],
            [
                HozzavaloKategoria::OLAJ,
                LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            ],
            [
                HozzavaloKategoria::ECET,
                LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            ],
            [
                HozzavaloKategoria::CUKRASZ,
                LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            ],
            [
                HozzavaloKategoria::AZSIAI,
                LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            ],
        ];
    }
}
