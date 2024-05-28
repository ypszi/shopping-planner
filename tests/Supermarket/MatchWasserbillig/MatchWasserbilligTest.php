<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\MatchWasserbillig;

use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\MatchWasserbillig\MatchWasserbillig;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MatchWasserbilligTest extends TestCase
{
    private Supermarket $supermarket;

    protected function setUp(): void
    {
        $this->supermarket = new MatchWasserbillig(
            $this->createMock(KategoriaMap::class),
            $this->createMock(HozzavaloToKategoriaMap::class)
        );
    }

    #[Test]
    public function testName(): void
    {
        $this->assertEquals('Match - Wasserbillig', $this->supermarket::name());
    }

    #[Test]
    public function testSorrend(): void
    {
        $this->assertEquals(
            [
                'Pékárú',
                'Zöldség / Gyümölcs',
                'Kávé / Tea',
                'Bor',
                'Tartós tejtermék',
                'Tejtermék',
                'Sajt',
                'Hús',
                'Hal',
                'Mirelit',
                'Felvágott',
                'Rizs / Tészta',
                'Fűszer',
                'Ázsiai',
                'Olaj / Ecet',
                'Konzerv',
                'Üditő',
            ],
            $this->supermarket::sorrend()
        );
    }
}
