<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Mertekegyseg\Atvaltas;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\KukoricaKonzerv;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Liszt;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Porcukor;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\VorosbabKonzerv;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
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
            'csirkemell db to dkg'    => [
                new Csirkemell(1, Mertekegyseg::DB),
                new Csirkemell(0, Mertekegyseg::DKG),
                25.0,
            ],
            'csirkemell db to kg'     => [
                new Csirkemell(1, Mertekegyseg::DB),
                new Csirkemell(0, Mertekegyseg::KG),
                0.25,
            ],
            'csirkemell dkg to db'    => [
                new Csirkemell(25, Mertekegyseg::DKG),
                new Csirkemell(0, Mertekegyseg::DB),
                1.0,
            ],
            'csirkemell kg to db'     => [
                new Csirkemell(1, Mertekegyseg::KG),
                new Csirkemell(0, Mertekegyseg::DB),
                4.0,
            ],
            'bogre to ml'             => [
                new NapraforgoOlaj(1, Mertekegyseg::BOGRE),
                new NapraforgoOlaj(0, Mertekegyseg::ML),
                250.0,
            ],
            'cl to dl'                => [
                new NapraforgoOlaj(1, Mertekegyseg::CL),
                new NapraforgoOlaj(0, Mertekegyseg::DL),
                0.1,
            ],
            'cl to l'                 => [
                new NapraforgoOlaj(1, Mertekegyseg::CL),
                new NapraforgoOlaj(0, Mertekegyseg::L),
                0.01,
            ],
            'cl to ml'                => [
                new NapraforgoOlaj(1, Mertekegyseg::CL),
                new NapraforgoOlaj(0, Mertekegyseg::ML),
                10.0,
            ],
            'csesze to ml'            => [
                new NapraforgoOlaj(1, Mertekegyseg::CSESZE),
                new NapraforgoOlaj(0, Mertekegyseg::ML),
                250.0,
            ],
            'dl to l'                 => [
                new NapraforgoOlaj(1, Mertekegyseg::DL),
                new NapraforgoOlaj(0, Mertekegyseg::L),
                0.1,
            ],
            'dl to cl'                => [
                new NapraforgoOlaj(1, Mertekegyseg::DL),
                new NapraforgoOlaj(0, Mertekegyseg::CL),
                10.0,
            ],
            'dl to ml'                => [
                new NapraforgoOlaj(1, Mertekegyseg::DL),
                new NapraforgoOlaj(0, Mertekegyseg::ML),
                100.0,
            ],
            'l to cl'                 => [
                new NapraforgoOlaj(1, Mertekegyseg::L),
                new NapraforgoOlaj(0, Mertekegyseg::CL),
                100.0,
            ],
            'l to dl'                 => [
                new NapraforgoOlaj(1, Mertekegyseg::L),
                new NapraforgoOlaj(0, Mertekegyseg::DL),
                10.0,
            ],
            'l to ml'                 => [
                new NapraforgoOlaj(1, Mertekegyseg::L),
                new NapraforgoOlaj(0, Mertekegyseg::ML),
                1000.0,
            ],
            'ml to cl'                => [
                new NapraforgoOlaj(1, Mertekegyseg::ML),
                new NapraforgoOlaj(0, Mertekegyseg::CL),
                0.1,
            ],
            'ml to dl'                => [
                new NapraforgoOlaj(1, Mertekegyseg::ML),
                new NapraforgoOlaj(0, Mertekegyseg::DL),
                0.01,
            ],
            'ml to l'                 => [
                new NapraforgoOlaj(1, Mertekegyseg::ML),
                new NapraforgoOlaj(0, Mertekegyseg::L),
                0.001,
            ],
            'dkg to g'                => [
                new Csirkemell(1, Mertekegyseg::DKG),
                new Csirkemell(0, Mertekegyseg::G),
                10.0,
            ],
            'dkg to kg'               => [
                new Csirkemell(1, Mertekegyseg::DKG),
                new Csirkemell(0, Mertekegyseg::KG),
                0.01,
            ],
            'g to dkg'                => [
                new Csirkemell(1, Mertekegyseg::G),
                new Csirkemell(0, Mertekegyseg::DKG),
                0.1,
            ],
            'g to kg'                 => [
                new Csirkemell(1, Mertekegyseg::G),
                new Csirkemell(0, Mertekegyseg::KG),
                0.001,
            ],
            'kg to dkg'               => [
                new Csirkemell(1, Mertekegyseg::KG),
                new Csirkemell(0, Mertekegyseg::DKG),
                100.0,
            ],
            'kg to g'                 => [
                new Csirkemell(1, Mertekegyseg::KG),
                new Csirkemell(0, Mertekegyseg::G),
                1000.0,
            ],
            'ek to dl'                => [
                new NapraforgoOlaj(1, Mertekegyseg::EK),
                new NapraforgoOlaj(0, Mertekegyseg::DL),
                0.15,
            ],
            'ek to ml'                => [
                new NapraforgoOlaj(1, Mertekegyseg::EK),
                new NapraforgoOlaj(0, Mertekegyseg::ML),
                15.0,
            ],
            'ek to tk'                => [
                new NapraforgoOlaj(1, Mertekegyseg::EK),
                new NapraforgoOlaj(3, Mertekegyseg::TK),
                3.0,
            ],
            'kvk to ml'               => [
                new NapraforgoOlaj(1, Mertekegyseg::KVK),
                new NapraforgoOlaj(0, Mertekegyseg::ML),
                5.0,
            ],
            'kk to ml'                => [
                new NapraforgoOlaj(1, Mertekegyseg::KK),
                new NapraforgoOlaj(0, Mertekegyseg::ML),
                5.0,
            ],
            'ml to ek'                => [
                new NapraforgoOlaj(1, Mertekegyseg::ML),
                new NapraforgoOlaj(0, Mertekegyseg::EK),
                1 / 15.0,
            ],
            'ml to kvk'               => [
                new NapraforgoOlaj(1, Mertekegyseg::ML),
                new NapraforgoOlaj(0, Mertekegyseg::KVK),
                0.2,
            ],
            'ml to kk'                => [
                new NapraforgoOlaj(1, Mertekegyseg::ML),
                new NapraforgoOlaj(0, Mertekegyseg::KK),
                0.2,
            ],
            'ml to mk'                => [
                new NapraforgoOlaj(1, Mertekegyseg::ML),
                new NapraforgoOlaj(0, Mertekegyseg::MK),
                0.5,
            ],
            'ml to tk'                => [
                new NapraforgoOlaj(1, Mertekegyseg::ML),
                new NapraforgoOlaj(0, Mertekegyseg::TK),
                0.2,
            ],
            'mk to ml'                => [
                new NapraforgoOlaj(1, Mertekegyseg::MK),
                new NapraforgoOlaj(0, Mertekegyseg::ML),
                2.0,
            ],
            'tk to ml'                => [
                new NapraforgoOlaj(1, Mertekegyseg::TK),
                new NapraforgoOlaj(0, Mertekegyseg::ML),
                5.0,
            ],
            'tk to dl'                => [
                new NapraforgoOlaj(1, Mertekegyseg::TK),
                new NapraforgoOlaj(0, Mertekegyseg::DL),
                0.05,
            ],
            'tk to ek'                => [
                new NapraforgoOlaj(1, Mertekegyseg::TK),
                new NapraforgoOlaj(0.3, Mertekegyseg::EK),
                0.3,
            ],
            'finomliszt bogre to dkg' => [
                new FinomLiszt(1, Mertekegyseg::BOGRE),
                new FinomLiszt(0, Mertekegyseg::DKG),
                15.0,
            ],
            'finomliszt bogre to g'   => [
                new FinomLiszt(1, Mertekegyseg::BOGRE),
                new FinomLiszt(0, Mertekegyseg::G),
                150.0,
            ],
            'finomliszt bogre to kg'  => [
                new FinomLiszt(1, Mertekegyseg::BOGRE),
                new FinomLiszt(0, Mertekegyseg::KG),
                0.15,
            ],
            'finomliszt ek to dkg'    => [
                new FinomLiszt(1, Mertekegyseg::EK),
                new FinomLiszt(0, Mertekegyseg::DKG),
                2.0,
            ],
            'finomliszt ek to g'      => [
                new FinomLiszt(1, Mertekegyseg::EK),
                new FinomLiszt(0, Mertekegyseg::G),
                20.0,
            ],
            'finomliszt ek to kg'     => [
                new FinomLiszt(1, Mertekegyseg::EK),
                new FinomLiszt(0, Mertekegyseg::KG),
                0.02,
            ],
            'liszt bogre to dkg'      => [
                new Liszt(1, Mertekegyseg::BOGRE),
                new Liszt(0, Mertekegyseg::DKG),
                15.0,
            ],
            'liszt bogre to g'        => [
                new Liszt(1, Mertekegyseg::BOGRE),
                new Liszt(0, Mertekegyseg::G),
                150.0,
            ],
            'liszt bogre to kg'       => [
                new Liszt(1, Mertekegyseg::BOGRE),
                new Liszt(0, Mertekegyseg::KG),
                0.15,
            ],
            'liszt ek to dkg'         => [
                new Liszt(1, Mertekegyseg::EK),
                new Liszt(0, Mertekegyseg::DKG),
                2.0,
            ],
            'liszt ek to g'           => [
                new Liszt(1, Mertekegyseg::EK),
                new Liszt(0, Mertekegyseg::G),
                20.0,
            ],
            'liszt ek to kg'          => [
                new Liszt(1, Mertekegyseg::EK),
                new Liszt(0, Mertekegyseg::KG),
                0.02,
            ],
            'porcukor ek to dkg'      => [
                new Porcukor(1, Mertekegyseg::EK),
                new Porcukor(0, Mertekegyseg::DKG),
                2.0,
            ],
            'porcukor ek to g'        => [
                new Porcukor(1, Mertekegyseg::EK),
                new Porcukor(0, Mertekegyseg::G),
                20.0,
            ],
            'porcukor ek to kg'       => [
                new Porcukor(1, Mertekegyseg::EK),
                new Porcukor(0, Mertekegyseg::KG),
                0.02,
            ],
            'cukor ek to dkg'         => [
                new Cukor(1, Mertekegyseg::EK),
                new Cukor(0, Mertekegyseg::DKG),
                2.0,
            ],
            'cukor ek to g'           => [
                new Cukor(1, Mertekegyseg::EK),
                new Cukor(0, Mertekegyseg::G),
                20.0,
            ],
            'cukor ek to kg'          => [
                new Cukor(1, Mertekegyseg::EK),
                new Cukor(0, Mertekegyseg::KG),
                0.02,
            ],
            'cukor mk to dkg'         => [
                new Cukor(1, Mertekegyseg::MK),
                new Cukor(0, Mertekegyseg::DKG),
                0.2,
            ],
            'cukor mk to g'           => [
                new Cukor(1, Mertekegyseg::MK),
                new Cukor(0, Mertekegyseg::G),
                2.0,
            ],
            'cukor mk to kg'          => [
                new Cukor(1, Mertekegyseg::MK),
                new Cukor(0, Mertekegyseg::KG),
                0.002,
            ],
            'cukor tk to dkg'         => [
                new Cukor(1, Mertekegyseg::TK),
                new Cukor(0, Mertekegyseg::DKG),
                0.6,
            ],
            'cukor tk to g'           => [
                new Cukor(1, Mertekegyseg::TK),
                new Cukor(0, Mertekegyseg::G),
                6.0,
            ],
            'cukor tk to kg'          => [
                new Cukor(1, Mertekegyseg::TK),
                new Cukor(0, Mertekegyseg::KG),
                0.006,
            ],
            'kukorica konzerv to g'   => [
                new KukoricaKonzerv(1, Mertekegyseg::KONZERV),
                new KukoricaKonzerv(0, Mertekegyseg::G),
                140.0,
            ],
            'vorosbab konzerv to g'   => [
                new VorosbabKonzerv(1, Mertekegyseg::KONZERV),
                new VorosbabKonzerv(0, Mertekegyseg::G),
                250.0,
            ],
            'tejfol ml to g'          => [
                new Tejfol(1, Mertekegyseg::ML),
                new Tejfol(0, Mertekegyseg::G),
                0.1,
            ],
            'tejfol cl to g'          => [
                new Tejfol(1, Mertekegyseg::CL),
                new Tejfol(0, Mertekegyseg::G),
                1.0,
            ],
            'tejfol dl to g'          => [
                new Tejfol(1, Mertekegyseg::DL),
                new Tejfol(0, Mertekegyseg::G),
                10.0,
            ],
            'So ek to g'              => [
                new So(1, Mertekegyseg::EK),
                new So(0, Mertekegyseg::G),
                20.0,
            ],
            'So tk to g'              => [
                new So(1, Mertekegyseg::TK),
                new So(0, Mertekegyseg::G),
                8.0,
            ],
            'So kvk to g'             => [
                new So(1, Mertekegyseg::KVK),
                new So(0, Mertekegyseg::G),
                2.0,
            ],
            'So kk to g'              => [
                new So(1, Mertekegyseg::KK),
                new So(0, Mertekegyseg::G),
                2.0,
            ],
        ];
    }

    #[Test]
    public function testNemValt(): void
    {
        $hozzavalo           = new Csirkemell(10, 'from');
        $hozzaadottHozzavalo = new Csirkemell(10, 'to');

        $this->expectException(UnknownUnitOfMeasureException::class);
        $this->expectExceptionMessage(sprintf('Cannot convert %s to %s', $hozzavalo, $hozzaadottHozzavalo));

        $this->sut->valt($hozzavalo, $hozzaadottHozzavalo);
    }
}
