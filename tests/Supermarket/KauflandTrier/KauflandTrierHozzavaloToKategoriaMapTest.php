<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Ecet;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrierHozzavaloToKategoriaMap;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class KauflandTrierHozzavaloToKategoriaMapTest extends TestCase
{
    #[Test]
    public function testMap(): void
    {
        $map = new KauflandTrierHozzavaloToKategoriaMap();

        $ecet       = new Ecet(1, Mertekegyseg::L);
        $csirkemell = new Csirkemell(1, Mertekegyseg::KG);

        $this->assertEquals(HozzavaloKategoria::ZOLDSEG->value(), $map->map($ecet)->value());
        $this->assertEquals($csirkemell->kategoria()->value(), $map->map($csirkemell)->value());
    }
}
