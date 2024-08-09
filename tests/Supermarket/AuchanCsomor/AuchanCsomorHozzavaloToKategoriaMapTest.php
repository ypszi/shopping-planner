<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\AuchanCsomor;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Eleszto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomorHozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomorKategoria;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AuchanCsomorHozzavaloToKategoriaMapTest extends TestCase
{
    #[Test]
    #[DataProvider('hozzavaloTokategoriaMapDataProvider')]
    public function testMap(Hozzavalo $from, Kategoria $to): void
    {
        $map = new AuchanCsomorHozzavaloToKategoriaMap();

        $this->assertEquals($to->value(), $map->map($from)->value());
    }

    public static function hozzavaloTokategoriaMapDataProvider(): array
    {
        return [
            [
                new Eleszto(1, Mertekegyseg::G),
                AuchanCsomorKategoria::TEJTERMEK,
            ],
            [
                new Csirkemell(1, Mertekegyseg::KG),
                (new Csirkemell(1, Mertekegyseg::KG))->kategoria(),
            ],
        ];
    }
}
