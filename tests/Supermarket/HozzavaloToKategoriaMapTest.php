<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\FetaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\TrappistaSajt;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HozzavaloToKategoriaMapTest extends TestCase
{
    private HozzavaloToKategoriaMap $sut;

    protected function setUp(): void
    {
        $this->sut = new class() extends HozzavaloToKategoriaMap {
            /**
             * @return array<string, Kategoria>
             */
            protected function hozzavaloMap(): array
            {
                return [
                    TrappistaSajt::name() => HozzavaloKategoria::FELVAGOTT,
                ];
            }
        };
    }

    #[Test]
    public function testMap(): void
    {
        $this->assertEquals('Felvágott', $this->sut->map(new TrappistaSajt(1, Mertekegyseg::G))->value());
    }

    #[Test]
    public function testMapWhenHozzavaloNotFoundInMap(): void
    {
        $this->assertEquals('Tejtermék', $this->sut->map(new FetaSajt(1, Mertekegyseg::G))->value());
    }
}
