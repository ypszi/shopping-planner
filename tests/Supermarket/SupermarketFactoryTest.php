<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Supermarket;

use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomor;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourg;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrier;
use PeterPecosz\Kajatervezo\Supermarket\LidlWasserbillig\LidlWasserbillig;
use PeterPecosz\Kajatervezo\Supermarket\MatchWasserbillig\MatchWasserbillig;
use PeterPecosz\Kajatervezo\Supermarket\SupermarketFactory;
use PeterPecosz\Kajatervezo\Supermarket\TescoFogarasi\TescoFogarasi;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SupermarketFactoryTest extends TestCase
{
    #[Test]
    public function testCreate(): void
    {
        $this->assertInstanceOf(AuchanCsomor::class, SupermarketFactory::create(AuchanCsomor::name()));
        $this->assertInstanceOf(TescoFogarasi::class, SupermarketFactory::create(TescoFogarasi::name()));
        $this->assertInstanceOf(KauflandTrier::class, SupermarketFactory::create(KauflandTrier::name()));
        $this->assertInstanceOf(AuchanLuxembourg::class, SupermarketFactory::create(AuchanLuxembourg::name()));
        $this->assertInstanceOf(LidlWasserbillig::class, SupermarketFactory::create(LidlWasserbillig::name()));
        $this->assertInstanceOf(MatchWasserbillig::class, SupermarketFactory::create(MatchWasserbillig::name()));
    }

    #[Test]
    public function testListAvailableSupermarkets(): void
    {
        $this->assertCount(5, SupermarketFactory::listAvailableSupermarkets());
    }
}
