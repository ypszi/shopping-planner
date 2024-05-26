<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket\AuchanLuxembourg;

use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourg;
use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AuchanLuxembourgTest extends TestCase
{
    private Supermarket $supermarket;

    protected function setUp(): void
    {
        $this->supermarket = new AuchanLuxembourg(
            $this->createMock(KategoriaMap::class),
            $this->createMock(HozzavaloToKategoriaMap::class)
        );
    }

    #[Test]
    public function testName(): void
    {
        $this->assertEquals('Auchan - Luxembourg', $this->supermarket::name());
    }

    #[Test]
    public function testSorrend(): void
    {
        $this->assertEquals(
            [
                'Üditő',
                'Konzerv, Szósz, Olaj, Ecet, Fűszer',
                'Tészta, Rizs, Paradicsomszósz, Puré',
                'Tea, Kávé',
                'Cukrász, Keksz',
                'Nemzetközi',
                'Mirelit',
                'Sajt',
                'Tartós tejtermék',
                'Tejtermék',
                'Hús',
                'Felvágott',
                'Joghurt',
                'Zöldség / Gyümölcs',
                'Hal',
                'Pékárú',
            ],
            $this->supermarket::sorrend()
        );
    }
}
