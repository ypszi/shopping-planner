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
    public function testWithMertekegyseg(): void
    {
        $hozzavalo = new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG);

        $this->assertEquals(new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::KG), $hozzavalo->withMertekegyseg(Mertekegyseg::KG));
    }

    #[Test]
    public function testWithMennyiseg(): void
    {
        $hozzavalo = new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG);

        $this->assertEquals(new Hozzavalo(Hozzavalo::CSIRKEMELL, 20, Mertekegyseg::DKG), $hozzavalo->withMennyiseg(20));
    }
}
