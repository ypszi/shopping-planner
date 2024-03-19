<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Mertekegyseg\Atvaltas;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PeterPecosz\Kajatervezo\Mertekegyseg\MertekegysegAtvalto;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MertekegysegAtvaltoTest extends TestCase
{
    private MertekegysegAtvalto $sut;

    protected function setUp(): void
    {
        $this->sut = new MertekegysegAtvalto();
    }

    #[Test]
    #[DataProvider('mertekegysegDataProvider')]
    public function testValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo, float $expectedMennyiseg): void
    {
        $this->assertEquals($expectedMennyiseg, $this->sut->valt($hozzavalo, $hozzaadottHozzavalo));
    }

    public static function mertekegysegDataProvider(): array
    {
        return [
            'bogre to ml'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::BOGRE),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::ML),
                250.0,
            ],
            'cl to dl'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::CL),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::DL),
                0.1,
            ],
            'cl to l'   => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::CL),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::L),
                0.01,
            ],
            'cl to ml'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::CL),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::ML),
                10.0,
            ],
            'csesze to ml'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::CSESZE),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::ML),
                250.0,
            ],
            'dl to cl'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::DL),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::CL),
                10.0,
            ],
            'dl to ml'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::DL),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::ML),
                100.0,
            ],
            'l to cl'   => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::L),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::CL),
                100.0,
            ],
            'l to dl'   => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::L),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::DL),
                10.0,
            ],
            'l to ml'   => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::L),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::ML),
                1000.0,
            ],
            'ml to cl'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::ML),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::CL),
                0.1,
            ],
            'ml to dl'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::ML),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::DL),
                0.01,
            ],
            'ml to l'   => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::ML),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::L),
                0.001,
            ],
            'dkg to g'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::DKG),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::G),
                10.0,
            ],
            'dkg to kg' => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::DKG),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::KG),
                0.01,
            ],
            'g to dkg'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::G),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::DKG),
                0.1,
            ],
            'g to kg'   => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::G),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::KG),
                0.001,
            ],
            'kg to dkg' => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::KG),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::DKG),
                100.0,
            ],
            'kg to g'   => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::KG),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::G),
                1000.0,
            ],
            'ek to dl'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::EK),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::DL),
                0.15,
            ],
            'ek to ml'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::EK),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::ML),
                15.0,
            ],
            'kvk to ml' => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::KVK),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::ML),
                5.0,
            ],
            'kk to ml'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::KK),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::ML),
                5.0,
            ],
            'ml to ek'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::ML),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::EK),
                1 / 15.0,
            ],
            'ml to kvk' => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::ML),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::KVK),
                0.2,
            ],
            'ml to kk'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::ML),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::KK),
                0.2,
            ],
            'ml to mk'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::ML),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::MK),
                0.5,
            ],
            'ml to tk'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::ML),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::TK),
                0.2,
            ],
            'mk to ml'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::MK),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::ML),
                2.0,
            ],
            'tk to ml'  => [
                new Hozzavalo('kategoria', 'name', 1, Mertekegyseg::TK),
                new Hozzavalo('kategoria', 'name', 0, Mertekegyseg::ML),
                5.0,
            ],
        ];
    }

    #[Test]
    public function testNemValt(): void
    {
        $hozzavalo = new Hozzavalo('kategoria', 'name', 10, 'from');
        $hozzaadottHozzavalo = new Hozzavalo('kategoria', 'name', 10, 'to');

        $this->expectException(UnknownUnitOfMeasureException::class);
        $this->expectExceptionMessage(sprintf('Cannot convert %s to %s', $hozzavalo, $hozzaadottHozzavalo));

        $this->sut->valt($hozzavalo, $hozzaadottHozzavalo);
    }
}
