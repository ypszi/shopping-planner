<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
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
                    'Trappista sajt' => HozzavaloKategoria::FELVAGOTT,
                ];
            }
        };
    }

    #[Test]
    public function testMap(): void
    {
        $this->assertEquals('Felvágott', $this->sut->map(new Hozzavalo('Trappista sajt', 1, Mertekegyseg::G, HozzavaloKategoria::SAJT ))->value());
    }

    #[Test]
    public function testMapWhenHozzavaloNotFoundInMap(): void
    {
        $this->assertEquals('Sajt', $this->sut->map(new Hozzavalo('Feta sajt', 1, Mertekegyseg::G, HozzavaloKategoria::SAJT))->value());
    }
}
