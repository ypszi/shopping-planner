<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Supermarket;

use PeterPecosz\ShoppingPlanner\Supermarket\Exception\UnknownSupermarketException;
use PeterPecosz\ShoppingPlanner\Supermarket\SupermarketFactory;
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
                'Bor',
                'Üditő',
                'Nemzetközi',
                'Olaj / Ecet',
                'Magvak',
                'Fűszer',
                'Konzerv',
                'Tészta / Rizs',
            ],
            $supermarket->toOrder()
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
        $this->assertEquals(
            [
                'Auchan - Csömör',
                'Lidl - Kistarcsa',
                'Tesco - Fogarasi',
            ],
            $this->sut->listAvailableSupermarkets()
        );
    }
}
