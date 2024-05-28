<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\MatchWasserbillig;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\MatchWasserbillig\MatchWasserbilligKategoria;
use PeterPecosz\Kajatervezo\Supermarket\MatchWasserbillig\MatchWasserbilligKategoriaMap;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MatchWasserbilligKategoriaMapTest extends TestCase
{
    #[Test]
    #[DataProvider('kategoriaMapDataProvider')]
    public function testMap(Kategoria $from, Kategoria $to): void
    {
        $map = new MatchWasserbilligKategoriaMap();

        $this->assertEquals($to->value(), $map->map($from)->value());
    }

    public static function kategoriaMapDataProvider(): array
    {
        return [
            [
                HozzavaloKategoria::PEKARU,
                MatchWasserbilligKategoria::PEKARU,
            ],
            [
                HozzavaloKategoria::ZOLDSEG_GYUMOLCS,
                MatchWasserbilligKategoria::ZOLDSEG_GYUMOLCS,
            ],
            [
                HozzavaloKategoria::FELVAGOTT,
                MatchWasserbilligKategoria::FELVAGOTT,
            ],
            [
                HozzavaloKategoria::HUS,
                MatchWasserbilligKategoria::HUS,
            ],
            [
                HozzavaloKategoria::HAL,
                MatchWasserbilligKategoria::HAL,
            ],
            [
                HozzavaloKategoria::FUSZER,
                MatchWasserbilligKategoria::FUSZER,
            ],
            [
                HozzavaloKategoria::SAJT,
                MatchWasserbilligKategoria::SAJT,
            ],
            [
                HozzavaloKategoria::TEJTERMEK,
                MatchWasserbilligKategoria::TEJTERMEK,
            ],
            [
                HozzavaloKategoria::UDITO,
                MatchWasserbilligKategoria::UDITO,
            ],
            [
                HozzavaloKategoria::MIRELIT,
                MatchWasserbilligKategoria::MIRELIT,
            ],
            [
                HozzavaloKategoria::BOR,
                MatchWasserbilligKategoria::BOR,
            ],
            [
                HozzavaloKategoria::TARTOS_TEJTERMEK,
                MatchWasserbilligKategoria::TARTOS_TEJTERMEK,
            ],
            [
                HozzavaloKategoria::TARTOS_ELELMISZER,
                MatchWasserbilligKategoria::RIZS_TESZTA,
            ],
            [
                HozzavaloKategoria::OLAJ,
                MatchWasserbilligKategoria::OLAJ_ECET,
            ],
            [
                HozzavaloKategoria::ECET,
                MatchWasserbilligKategoria::OLAJ_ECET,
            ],
            [
                HozzavaloKategoria::CUKRASZ,
                MatchWasserbilligKategoria::RIZS_TESZTA,
            ],
            [
                HozzavaloKategoria::AZSIAI,
                MatchWasserbilligKategoria::AZSIAI,
            ],
        ];
    }
}
