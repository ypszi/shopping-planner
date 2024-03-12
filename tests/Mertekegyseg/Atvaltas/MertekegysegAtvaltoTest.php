<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Mertekegyseg\Atvaltas;

use LogicException;
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
    public function testValt(float $mennyiseg, string $from, string $to, float $expectedMennyiseg): void
    {
        $this->assertEquals($expectedMennyiseg, $this->sut->valt($mennyiseg, $from, $to));
    }

    public static function mertekegysegDataProvider(): array
    {
        return [
            'cl to dl'  => [
                1,
                Mertekegyseg::CL,
                Mertekegyseg::DL,
                0.1,
            ],
            'cl to l'   => [
                1,
                Mertekegyseg::CL,
                Mertekegyseg::L,
                0.01,
            ],
            'cl to ml'  => [
                1,
                Mertekegyseg::CL,
                Mertekegyseg::ML,
                10.0,
            ],
            'dl to cl'  => [
                1,
                Mertekegyseg::DL,
                Mertekegyseg::CL,
                10.0,
            ],
            'dl to ml'  => [
                1,
                Mertekegyseg::DL,
                Mertekegyseg::ML,
                100.0,
            ],
            'l to cl'   => [
                1,
                Mertekegyseg::L,
                Mertekegyseg::CL,
                100.0,
            ],
            'l to dl'   => [
                1,
                Mertekegyseg::L,
                Mertekegyseg::DL,
                10.0,
            ],
            'l to ml'   => [
                1,
                Mertekegyseg::L,
                Mertekegyseg::ML,
                1000.0,
            ],
            'ml to cl'  => [
                1,
                Mertekegyseg::ML,
                Mertekegyseg::CL,
                0.1,
            ],
            'ml to dl'  => [
                1,
                Mertekegyseg::ML,
                Mertekegyseg::DL,
                0.01,
            ],
            'ml to l'   => [
                1,
                Mertekegyseg::ML,
                Mertekegyseg::L,
                0.001,
            ],
            'dkg to g'  => [
                1,
                Mertekegyseg::DKG,
                Mertekegyseg::G,
                10.0,
            ],
            'dkg to kg' => [
                1,
                Mertekegyseg::DKG,
                Mertekegyseg::KG,
                0.01,
            ],
            'g to dkg'  => [
                1,
                Mertekegyseg::G,
                Mertekegyseg::DKG,
                0.1,
            ],
            'g to kg'   => [
                1,
                Mertekegyseg::G,
                Mertekegyseg::KG,
                0.001,
            ],
            'kg to dkg' => [
                1,
                Mertekegyseg::KG,
                Mertekegyseg::DKG,
                100.0,
            ],
            'kg to g'   => [
                1,
                Mertekegyseg::KG,
                Mertekegyseg::G,
                1000.0,
            ],
            'ek to ml'  => [
                1,
                Mertekegyseg::EK,
                Mertekegyseg::ML,
                15.0,
            ],
            'kvk to ml' => [
                1,
                Mertekegyseg::KVK,
                Mertekegyseg::ML,
                5.0,
            ],
            'kk to ml'  => [
                1,
                Mertekegyseg::KK,
                Mertekegyseg::ML,
                5.0,
            ],
            'ml to ek'  => [
                1,
                Mertekegyseg::ML,
                Mertekegyseg::EK,
                1 / 15.0,
            ],
            'ml to kvk' => [
                1,
                Mertekegyseg::ML,
                Mertekegyseg::KVK,
                0.2,
            ],
            'ml to kk'  => [
                1,
                Mertekegyseg::ML,
                Mertekegyseg::KK,
                0.2,
            ],
            'ml to mk'  => [
                1,
                Mertekegyseg::ML,
                Mertekegyseg::MK,
                0.5,
            ],
            'ml to tk'  => [
                1,
                Mertekegyseg::ML,
                Mertekegyseg::TK,
                0.2,
            ],
            'mk to ml'  => [
                1,
                Mertekegyseg::MK,
                Mertekegyseg::ML,
                2.0,
            ],
            'tk to ml'  => [
                1,
                Mertekegyseg::TK,
                Mertekegyseg::ML,
                5.0,
            ],
        ];
    }

    #[Test]
    public function testNemValt(): void
    {
        $mertekegyseget = 'from';
        $mertekegysegre = 'to';

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(sprintf('Cannot convert %s to %s', $mertekegyseget, $mertekegysegre));

        $this->sut->valt(10, $mertekegyseget, $mertekegysegre);
    }
}
