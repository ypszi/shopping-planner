<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Integration\Supermarket;

use PeterPecosz\ShoppingPlanner\Measure\MeasureConverter;
use PeterPecosz\ShoppingPlanner\Supermarket\Exception\UnknownSupermarketException;
use PeterPecosz\ShoppingPlanner\Supermarket\SupermarketFactory;
use PeterPecosz\ShoppingPlanner\Tests\Support\Resource;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SupermarketFactoryTest extends TestCase
{
    private MeasureConverter&MockObject $measureConverter;

    private SupermarketFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new SupermarketFactory(
            Resource::Supermarkets->value,
            $this->measureConverter = $this->createMock(MeasureConverter::class)
        );
    }

    #[Test]
    public function testCreate(): void
    {
        $this->measureConverter
            ->expects($this->never())
            ->method('convert');

        $supermarket = $this->sut->create('Auchan - Csömör');

        $this->assertEquals('Auchan - Csömör', $supermarket->name());
        $this->assertEquals(
            [
                'Zöldség / Gyümölcs',
                'Pékárú',
                'Mirelit',
                'Tartós tejtermék',
                'Hal',
                'Hús',
                'Tejtermék',
                'Felvágott',
                'Bor',
                'Üditő',
                'Keksz / Műzli',
                'Kávé',
                'Sütés / Sütemény',
                'Magvak',
                'Nemzetközi',
                'Olaj / Ecet',
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

        $this->measureConverter
            ->expects($this->never())
            ->method('convert');

        $this->sut->create('Auchan');
    }

    #[Test]
    public function testListAvailableSupermarkets(): void
    {
        $this->measureConverter
            ->expects($this->never())
            ->method('convert');

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
