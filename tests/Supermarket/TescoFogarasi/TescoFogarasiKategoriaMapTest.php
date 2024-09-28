<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\TescoFogarasi;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\TescoFogarasi\TescoFogarasiKategoria;
use PeterPecosz\Kajatervezo\Supermarket\TescoFogarasi\TescoFogarasiKategoriaMap;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TescoFogarasiKategoriaMapTest extends TestCase
{
    #[Test]
    #[DataProvider('kategoriaMapDataProvider')]
    public function testMap(Kategoria $from, Kategoria $to): void
    {
        $map = new TescoFogarasiKategoriaMap();

        $this->assertEquals($to->value(), $map->map($from)->value());
    }

    public static function kategoriaMapDataProvider(): array
    {
        return [
            [
                HozzavaloKategoria::UDITO,
                TescoFogarasiKategoria::UDITO,
            ],
            [
                HozzavaloKategoria::BOR,
                TescoFogarasiKategoria::UDITO,
            ],
            [
                HozzavaloKategoria::OLAJ,
                TescoFogarasiKategoria::OLAJ_ECET,
            ],
            [
                HozzavaloKategoria::ECET,
                TescoFogarasiKategoria::OLAJ_ECET,
            ],
            [
                HozzavaloKategoria::FUSZER,
                TescoFogarasiKategoria::FUSZER,
            ],
            [
                HozzavaloKategoria::TARTOS_ELELMISZER,
                TescoFogarasiKategoria::TESZTA_RIZS,
            ],
            [
                HozzavaloKategoria::CUKRASZ,
                TescoFogarasiKategoria::CUKOR_LISZT_SUTEMENY,
            ],
            [
                HozzavaloKategoria::AZSIAI,
                TescoFogarasiKategoria::TESZTA_RIZS,
            ],
            [
                HozzavaloKategoria::MIRELIT,
                TescoFogarasiKategoria::MIRELIT,
            ],
            [
                HozzavaloKategoria::SAJT,
                TescoFogarasiKategoria::SAJT,
            ],
            [
                HozzavaloKategoria::TARTOS_TEJTERMEK,
                TescoFogarasiKategoria::TARTOS_TEJTERMEK,
            ],
            [
                HozzavaloKategoria::TEJTERMEK,
                TescoFogarasiKategoria::TEJTERMEK,
            ],
            [
                HozzavaloKategoria::HUS,
                TescoFogarasiKategoria::HUS,
            ],
            [
                HozzavaloKategoria::FELVAGOTT,
                TescoFogarasiKategoria::FELVAGOTT,
            ],
            [
                HozzavaloKategoria::ZOLDSEG_GYUMOLCS,
                TescoFogarasiKategoria::ZOLDSEG_GYUMOLCS,
            ],
            [
                HozzavaloKategoria::HAL,
                TescoFogarasiKategoria::MIRELIT,
            ],
            [
                HozzavaloKategoria::PEKARU,
                TescoFogarasiKategoria::PEKARU,
            ],
        ];
    }
}
