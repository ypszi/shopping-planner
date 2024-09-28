<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Hozzavalo;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HozzavaloTest extends TestCase
{
    private Hozzavalo $testHozzavalo;

    protected function setUp(): void
    {
        $this->testHozzavalo = new Hozzavalo(
            name:         'Teszt hozzavalo',
            mennyiseg:    50,
            mertekegyseg: Mertekegyseg::DB,
            kategoria:    HozzavaloKategoria::HUS
        );
    }

    #[Test]
    public function testWithMertekegyseg(): void
    {
        $testHozzavalo = $this->testHozzavalo->withMertekegyseg(Mertekegyseg::KG);

        $this->assertEquals(50, $testHozzavalo->getMennyiseg());
        $this->assertEquals(Mertekegyseg::KG, $testHozzavalo->getMertekegyseg());
        $this->assertEquals(HozzavaloKategoria::HUS, $testHozzavalo->kategoria());
    }

    #[Test]
    public function testWithMennyiseg(): void
    {
        $testHozzavalo = $this->testHozzavalo->withMennyiseg(20);

        $this->assertEquals(20, $testHozzavalo->getMennyiseg());
        $this->assertEquals(Mertekegyseg::DB, $testHozzavalo->getMertekegyseg());
        $this->assertEquals(HozzavaloKategoria::HUS, $testHozzavalo->kategoria());
    }

    #[Test]
    public function testWithKategoria(): void
    {
        $testHozzavalo = $this->testHozzavalo->withKategoria(HozzavaloKategoria::UDITO);

        $this->assertEquals(50, $testHozzavalo->getMennyiseg());
        $this->assertEquals(Mertekegyseg::DB, $testHozzavalo->getMertekegyseg());
        $this->assertEquals(HozzavaloKategoria::UDITO, $testHozzavalo->kategoria());
    }
}
