<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrierKategoriaMap;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class KauflandTrierKategoriaMapTest extends TestCase
{
    #[Test]
    public function testMap(): void
    {
        $map = new KauflandTrierKategoriaMap();

        $this->assertEquals(HozzavaloKategoria::ZOLDSEG->value(), $map->map(HozzavaloKategoria::ZOLDSEG)->value());
        $this->assertEquals(HozzavaloKategoria::FUSZER_ES_OLAJ->value(), $map->map(HozzavaloKategoria::FUSZER_ES_OLAJ)->value());
        $this->assertEquals(HozzavaloKategoria::HOSSZU_SOROK->value(), $map->map(HozzavaloKategoria::HOSSZU_SOROK)->value());
        $this->assertEquals(HozzavaloKategoria::HUS->value(), $map->map(HozzavaloKategoria::HUS)->value());
        $this->assertEquals(HozzavaloKategoria::HUTOS->value(), $map->map(HozzavaloKategoria::HUTOS)->value());
        $this->assertEquals(HozzavaloKategoria::HUTOS_UTAN->value(), $map->map(HozzavaloKategoria::HUTOS_UTAN)->value());
        $this->assertEquals(HozzavaloKategoria::UDITOK->value(), $map->map(HozzavaloKategoria::UDITOK)->value());
    }
}
