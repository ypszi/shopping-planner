<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\TescoFogarasi;

use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PeterPecosz\Kajatervezo\Supermarket\TescoFogarasi\TescoFogarasi;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TescoFogarasiTest extends TestCase
{
    private Supermarket $supermarket;

    protected function setUp(): void
    {
        $this->supermarket = new TescoFogarasi(
            $this->createMock(KategoriaMap::class),
            $this->createMock(HozzavaloToKategoriaMap::class)
        );
    }

    #[Test]
    public function testName(): void
    {
        $this->assertEquals('Tesco - Fogarasi', $this->supermarket::name());
    }

    #[Test]
    public function testSorrend(): void
    {
        $this->assertEquals(
            [
                'Zöldség / Gyümölcs',
                'Pékárú',
                'Felvágott',
                'Sajt',
                'Tejtermék',
                'Hús',
                'Tartós tejtermék',
                'Tészta / Rizs',
                'Mirelit',
                'Olaj / Ecet',
                'Konzerv',
                'Fűszer',
                'Cukor / Liszt / Sütemény',
                'Mogyoró / Chips / Snacks',
                'Édesség / Keksz',
                'Üditő',
            ],
            $this->supermarket::sorrend()
        );
    }
}
