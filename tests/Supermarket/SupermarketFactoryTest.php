<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket;

use PeterPecosz\Kajatervezo\Supermarket\Exception\UnknownSupermarketException;
use PeterPecosz\Kajatervezo\Supermarket\SupermarketFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SupermarketFactoryTest extends TestCase
{
    private SupermarketFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new SupermarketFactory(
            __DIR__ . '/../../app/supermarkets.yaml'
        );
    }

    #[Test]
    public function testCreate(): void
    {
        $supermarket = $this->sut->create('Auchan - Csömör');

        $this->assertEquals('Auchan - Csömör', $supermarket->name());
        $this->assertEquals(
            [
                'Zöldség / Gyümölcs',
                'Pékárú',
                'Hal',
                'Mirelit',
                'Tejtermék',
                'Tartós tejtermék',
                'Hús',
                'Felvágott',
                'Sütés / Sütemény',
                'Üditő',
                'Nemzetközi',
                'Olaj / Ecet',
                'Fűszer',
                'Konzerv',
                'Tészta / Rizs',
            ],
            $supermarket->sorrend()
        );
    }

    #[Test]
    public function testCreateFailsOnUnknownSupermarket(): void
    {
        $this->expectException(UnknownSupermarketException::class);
        $this->expectExceptionMessage('Unknown supermarket: "Auchan"');

        $this->sut->create('Auchan');
    }

    #[Test]
    public function testListAvailableSupermarkets(): void
    {
        $this->assertCount(2, $this->sut->listAvailableSupermarkets());
    }
}
