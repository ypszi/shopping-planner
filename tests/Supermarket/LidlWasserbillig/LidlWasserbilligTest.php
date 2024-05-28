<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\LidlWasserbillig;

use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\LidlWasserbillig\LidlWasserbillig;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class LidlWasserbilligTest extends TestCase
{
    private Supermarket $supermarket;

    protected function setUp(): void
    {
        $this->supermarket = new LidlWasserbillig(
            $this->createMock(KategoriaMap::class),
            $this->createMock(HozzavaloToKategoriaMap::class)
        );
    }

    #[Test]
    public function testName(): void
    {
        $this->assertEquals('Lidl - Wasserbillig', $this->supermarket::name());
    }

    #[Test]
    public function testSorrend(): void
    {
        $this->assertEquals(
            [
                'Müzli/ Pékárú',
                'Zöldség / Gyümölcs',
                'Kave / Tea / Keksz',
                'Felvágott',
                'Hús',
                'Fűszer / Hal',
                'Sajt',
                'Tejtermék',
                'Üditő',
                'Mirelit',
                'Sós rágcsa / Sör / Bor',
                'Tartós tejtermék / Csoki / Tojás / Olaj / Ecet / Tészta / Konzerv',
            ],
            $this->supermarket::sorrend()
        );
    }
}
