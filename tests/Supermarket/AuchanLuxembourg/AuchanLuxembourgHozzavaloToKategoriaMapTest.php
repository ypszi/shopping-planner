<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\AuchanLuxembourg;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\TonhalKonzerv;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\FetaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\GoudaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\MozzarellaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\MozzarellaSajtReszelt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\ParmezanSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\TrappistaSajt;
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
                new FetaSajt(1, Mertekegyseg::G),
                AuchanLuxembourgKategoria::SAJT,
            ],
            [
                new GoudaSajt(1, Mertekegyseg::G),
                AuchanLuxembourgKategoria::SAJT,
            ],
            [
                new MozzarellaSajt(1, Mertekegyseg::G),
                AuchanLuxembourgKategoria::SAJT,
            ],
            [
                new MozzarellaSajtReszelt(1, Mertekegyseg::G),
                AuchanLuxembourgKategoria::SAJT,
            ],
            [
                new ParmezanSajt(1, Mertekegyseg::G),
                AuchanLuxembourgKategoria::SAJT,
            ],
            [
                new Tojas(1, Mertekegyseg::DB),
                AuchanLuxembourgKategoria::TARTOS_TEJTERMEK,
            ],
            [
                new TonhalKonzerv(1, Mertekegyseg::G),
                AuchanLuxembourgKategoria::NEMZETKOZI,
            ],
            [
                new TrappistaSajt(1, Mertekegyseg::G),
                AuchanLuxembourgKategoria::SAJT,
            ],
            [
                new Csirkemell(1, Mertekegyseg::KG),
                (new Csirkemell(1, Mertekegyseg::KG))->kategoria(),
            ],
        ];
    }
}
