<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\AuchanCsomor;

use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomor;
use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AuchanCsomorTest extends TestCase
{
    private Supermarket $supermarket;

    protected function setUp(): void
    {
        $this->supermarket = new AuchanCsomor(
            $this->createMock(KategoriaMap::class),
            $this->createMock(HozzavaloToKategoriaMap::class)
        );
    }

    #[Test]
    public function testName(): void
    {
        $this->assertEquals('Auchan - Csömör', $this->supermarket::name());
    }

    #[Test]
    public function testSorrend(): void
    {
        $this->assertEquals(
            [
                'Zöldség / Gyümölcs',
                'Hal',
                'Pékárú',
                'Mirelit',
                'Tejtermék',
                'Tartós tejtermék',
                'Hús',
                'Felvágott',
                'Sütemény',
                'Üditő',
                'Nemzetközi',
                'Olaj / Ecet',
                'Fűszer',
                'Konzerv',
                'Tészta / Rizs',
            ],
            $this->supermarket::sorrend()
        );
    }
}
