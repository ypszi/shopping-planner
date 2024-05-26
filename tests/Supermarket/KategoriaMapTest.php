<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class KategoriaMapTest extends TestCase
{
    private KategoriaMap $sut;

    protected function setUp(): void
    {
        $this->sut = new class() extends KategoriaMap {
            /**
             * @return array<string, Kategoria>
             */
            #[Override] protected function kategoriaMap(): array
            {
                return [
                    HozzavaloKategoria::BOR->value => HozzavaloKategoria::TEJTERMEK,
                ];
            }
        };
    }

    #[Test]
    public function testMap(): void
    {
        $this->assertEquals('Tejtermék', $this->sut->map(HozzavaloKategoria::BOR)->value());
    }

    #[Test]
    public function testMapWhenKategoriaNotFoundInMap(): void
    {
        $this->assertEquals('Tejtermék', $this->sut->map(HozzavaloKategoria::TEJTERMEK)->value());
    }
}
