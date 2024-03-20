<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Hozzavalo;

use PeterPecosz\Kajatervezo\Hozzavalo\Exception\UnknownHozzavaloException;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HozzavaloTest extends TestCase
{
    #[Test]
    public function testUnknownHozzavalo(): void
    {
        $this->expectException(UnknownHozzavaloException::class);
        $this->expectExceptionMessage('Unknown hozzavalo, cannot determine kategoria for "unknown ingredient"');

        new Hozzavalo('unknown ingredient', 10, Mertekegyseg::G);
    }

    #[Test]
    public function testFromHozzavalo(): void
    {
        $hozzavalo = new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG);

        $this->assertEquals(new Hozzavalo(Hozzavalo::CSIRKEMELL, 20, Mertekegyseg::KG), Hozzavalo::fromHozzavalo($hozzavalo, 20, Mertekegyseg::KG));
    }

    #[Test]
    public function testFromHozzavaloWithMertekegyseg(): void
    {
        $hozzavalo = new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG);

        $this->assertEquals(new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::KG), Hozzavalo::fromHozzavaloWithMertekegyseg($hozzavalo, Mertekegyseg::KG));
    }

    #[Test]
    public function testFromHozzavaloWithMennyiseg(): void
    {
        $hozzavalo = new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG);

        $this->assertEquals(new Hozzavalo(Hozzavalo::CSIRKEMELL, 20, Mertekegyseg::DKG), Hozzavalo::fromHozzavaloWithMennyiseg($hozzavalo, 20));
    }
}
