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
            'csirkemell db to dkg'    => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::DB, 'Hús'),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::DKG, 'Hús'),
                25.0,
            ],
            'csirkemell db to kg'     => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::DB, 'Hús'),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::KG, 'Hús'),
                0.25,
            ],
            'csirkemell dkg to db'    => [
                new Hozzavalo('Csirkemell', 25, Mertekegyseg::DKG, 'Hús'),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::DB, 'Hús'),
                1.0,
            ],
            'csirkemell kg to db'     => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::KG, 'Hús'),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::DB, 'Hús'),
                4.0,
            ],
            'bogre to ml'             => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::BOGRE, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                250.0,
            ],
            'cl to dl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::CL, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::DL, 'Olaj'),
                0.1,
            ],
            'cl to l'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::CL, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, 'Olaj'),
                0.01,
            ],
            'cl to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::CL, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                10.0,
            ],
            'csesze to ml'            => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::CSESZE, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                250.0,
            ],
            'dl to l'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::DL, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, 'Olaj'),
                0.1,
            ],
            'dl to cl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::DL, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::CL, 'Olaj'),
                10.0,
            ],
            'dl to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::DL, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                100.0,
            ],
            'l to cl'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::L, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::CL, 'Olaj'),
                100.0,
            ],
            'l to dl'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::L, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::DL, 'Olaj'),
                10.0,
            ],
            'l to ml'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::L, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                1000.0,
            ],
            'ml to cl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::CL, 'Olaj'),
                0.1,
            ],
            'ml to dl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::DL, 'Olaj'),
                0.01,
            ],
            'ml to l'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, 'Olaj'),
                0.001,
            ],
            'dkg to g'                => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::DKG, 'Hús'),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::G, 'Hús'),
                10.0,
            ],
            'dkg to kg'               => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::DKG, 'Hús'),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::KG, 'Hús'),
                0.01,
            ],
            'g to dkg'                => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::G, 'Hús'),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::DKG, 'Hús'),
                0.1,
            ],
            'g to kg'                 => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::G, 'Hús'),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::KG, 'Hús'),
                0.001,
            ],
            'kg to dkg'               => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::KG, 'Hús'),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::DKG, 'Hús'),
                100.0,
            ],
            'kg to g'                 => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::KG, 'Hús'),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::G, 'Hús'),
                1000.0,
            ],
            'ek to dl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::DL, 'Olaj'),
                0.15,
            ],
            'ek to kvk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 3, Mertekegyseg::KVK, 'Olaj'),
                15.0 / 5.0,
            ],
            'ek to kk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 3, Mertekegyseg::KK, 'Olaj'),
                15.0 / 5.0,
            ],
            'ek to l'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, 'Olaj'),
                0.015,
            ],
            'ek to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                15.0,
            ],
            'ek to mk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::MK, 'Olaj'),
                15.0 / 2.0,
            ],
            'ek to tk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 3, Mertekegyseg::TK, 'Olaj'),
                15.0 / 5.0,
            ],
            'kvk to ek'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::EK, 'Olaj'),
                5.0 / 15.0,
            ],
            'kvk to kk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KK, 'Olaj'),
                1.0,
            ],
            'kvk to l'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, 'Olaj'),
                0.005,
            ],
            'kvk to ml'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                5.0,
            ],
            'kvk to mk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::MK, 'Olaj'),
                5.0 / 2.0,
            ],
            'kvk to tk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 3, Mertekegyseg::TK, 'Olaj'),
                1.0,
            ],
            'kk to ek'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::EK, 'Olaj'),
                5.0 / 15.0,
            ],
            'kk to kvk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KVK, 'Olaj'),
                1.0,
            ],
            'kk to l'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, 'Olaj'),
                0.005,
            ],
            'kk to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                5.0,
            ],
            'kk to mk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::MK, 'Olaj'),
                5.0 / 2.0,
            ],
            'kk to tk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::TK, 'Olaj'),
                1.0,
            ],
            'ml to ek'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::EK, 'Olaj'),
                1 / 15.0,
            ],
            'ml to kvk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KVK, 'Olaj'),
                0.2,
            ],
            'ml to kk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KK, 'Olaj'),
                0.2,
            ],
            'ml to mk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::MK, 'Olaj'),
                0.5,
            ],
            'ml to tk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::TK, 'Olaj'),
                0.2,
            ],
            'ml to csepp'             => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 20, Mertekegyseg::CSEPP, 'Olaj'),
                20.0,
            ],
            'csepp to ml'             => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::CSEPP, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                0.05,
            ],
            'mk to ek'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::EK, 'Olaj'),
                2.0 / 15.0,
            ],
            'mk to kvk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KVK, 'Olaj'),
                2.0 / 5.0,
            ],
            'mk to kk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KK, 'Olaj'),
                2.0 / 5.0,
            ],
            'mk to l'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, 'Olaj'),
                0.002,
            ],
            'mk to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                2.0,
            ],
            'mk to tk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::TK, 'Olaj'),
                2.0 / 5.0,
            ],
            'tk to dl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::DL, 'Olaj'),
                0.05,
            ],
            'tk to ek'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0.3, Mertekegyseg::EK, 'Olaj'),
                5.0 / 15.0,
            ],
            'tk to kvk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0.3, Mertekegyseg::KVK, 'Olaj'),
                1.0,
            ],
            'tk to kk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0.3, Mertekegyseg::KK, 'Olaj'),
                1.0,
            ],
            'tk to l'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, 'Olaj'),
                0.005,
            ],
            'tk to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, 'Olaj'),
                5.0,
            ],
            'tk to mk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, 'Olaj'),
                new Hozzavalo('Napraforgó olaj', 0.3, Mertekegyseg::MK, 'Olaj'),
                5.0 / 2.0,
            ],
            'finomliszt bogre to dkg' => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::BOGRE, 'Sütés / Sütemény'),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::DKG, 'Sütés / Sütemény'),
                15.0,
            ],
            'finomliszt bogre to g'   => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::BOGRE, 'Sütés / Sütemény'),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::G, 'Sütés / Sütemény'),
                150.0,
            ],
            'finomliszt bogre to kg'  => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::BOGRE, 'Sütés / Sütemény'),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::KG, 'Sütés / Sütemény'),
                0.15,
            ],
            'finomliszt ek to dkg'    => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::DKG, 'Sütés / Sütemény'),
                2.0,
            ],
            'finomliszt ek to g'      => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::G, 'Sütés / Sütemény'),
                20.0,
            ],
            'finomliszt ek to kg'     => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::KG, 'Sütés / Sütemény'),
                0.02,
            ],
            'liszt bogre to dkg'      => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::BOGRE, 'Sütés / Sütemény'),
                new Hozzavalo('Liszt', 0, Mertekegyseg::DKG, 'Sütés / Sütemény'),
                15.0,
            ],
            'liszt bogre to g'        => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::BOGRE, 'Sütés / Sütemény'),
                new Hozzavalo('Liszt', 0, Mertekegyseg::G, 'Sütés / Sütemény'),
                150.0,
            ],
            'liszt bogre to kg'       => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::BOGRE, 'Sütés / Sütemény'),
                new Hozzavalo('Liszt', 0, Mertekegyseg::KG, 'Sütés / Sütemény'),
                0.15,
            ],
            'liszt ek to dkg'         => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Liszt', 0, Mertekegyseg::DKG, 'Sütés / Sütemény'),
                2.0,
            ],
            'liszt ek to g'           => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Liszt', 0, Mertekegyseg::G, 'Sütés / Sütemény'),
                20.0,
            ],
            'liszt ek to kg'          => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Liszt', 0, Mertekegyseg::KG, 'Sütés / Sütemény'),
                0.02,
            ],
            'porcukor ek to dkg'      => [
                new Hozzavalo('Porcukor', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Porcukor', 0, Mertekegyseg::DKG, 'Sütés / Sütemény'),
                2.0,
            ],
            'porcukor ek to g'        => [
                new Hozzavalo('Porcukor', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Porcukor', 0, Mertekegyseg::G, 'Sütés / Sütemény'),
                20.0,
            ],
            'porcukor ek to kg'       => [
                new Hozzavalo('Porcukor', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Porcukor', 0, Mertekegyseg::KG, 'Sütés / Sütemény'),
                0.02,
            ],
            'cukor ek to dkg'         => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Cukor', 0, Mertekegyseg::DKG, 'Sütés / Sütemény'),
                2.0,
            ],
            'cukor ek to g'           => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Cukor', 0, Mertekegyseg::G, 'Sütés / Sütemény'),
                20.0,
            ],
            'cukor ek to kg'          => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::EK, 'Sütés / Sütemény'),
                new Hozzavalo('Cukor', 0, Mertekegyseg::KG, 'Sütés / Sütemény'),
                0.02,
            ],
            'cukor mk to dkg'         => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::MK, 'Sütés / Sütemény'),
                new Hozzavalo('Cukor', 0, Mertekegyseg::DKG, 'Sütés / Sütemény'),
                0.2,
            ],
            'cukor mk to g'           => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::MK, 'Sütés / Sütemény'),
                new Hozzavalo('Cukor', 0, Mertekegyseg::G, 'Sütés / Sütemény'),
                2.0,
            ],
            'cukor mk to kg'          => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::MK, 'Sütés / Sütemény'),
                new Hozzavalo('Cukor', 0, Mertekegyseg::KG, 'Sütés / Sütemény'),
                0.002,
            ],
            'cukor tk to dkg'         => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::TK, 'Sütés / Sütemény'),
                new Hozzavalo('Cukor', 0, Mertekegyseg::DKG, 'Sütés / Sütemény'),
                0.6,
            ],
            'cukor tk to g'           => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::TK, 'Sütés / Sütemény'),
                new Hozzavalo('Cukor', 0, Mertekegyseg::G, 'Sütés / Sütemény'),
                6.0,
            ],
            'cukor tk to kg'          => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::TK, 'Sütés / Sütemény'),
                new Hozzavalo('Cukor', 0, Mertekegyseg::KG, 'Sütés / Sütemény'),
                0.006,
            ],
            'kukorica konzerv to g'   => [
                new Hozzavalo('Kukorica (konzerv)', 1, Mertekegyseg::KONZERV, 'Tartós élelmiszer'),
                new Hozzavalo('Kukorica (konzerv)', 0, Mertekegyseg::G, 'Tartós élelmiszer'),
                140.0,
            ],
            'vorosbab konzerv to g'   => [
                new Hozzavalo('Vörösbab (konzerv)', 1, Mertekegyseg::KONZERV, 'Tartós élelmiszer'),
                new Hozzavalo('Vörösbab (konzerv)', 0, Mertekegyseg::G, 'Tartós élelmiszer'),
                250.0,
            ],
            'tejfol ml to g'          => [
                new Hozzavalo('Tejföl', 1, Mertekegyseg::ML, 'Tejtermék'),
                new Hozzavalo('Tejföl', 0, Mertekegyseg::G, 'Tejtermék'),
                0.1,
            ],
            'tejfol cl to g'          => [
                new Hozzavalo('Tejföl', 1, Mertekegyseg::CL, 'Tejtermék'),
                new Hozzavalo('Tejföl', 0, Mertekegyseg::G, 'Tejtermék'),
                1.0,
            ],
            'tejfol dl to g'          => [
                new Hozzavalo('Tejföl', 1, Mertekegyseg::DL, 'Tejtermék'),
                new Hozzavalo('Tejföl', 0, Mertekegyseg::G, 'Tejtermék'),
                10.0,
            ],
            'So csipet to g'          => [
                new Hozzavalo('Só', 1, Mertekegyseg::CSIPET, 'Fűszer'),
                new Hozzavalo('Só', 0, Mertekegyseg::G, 'Fűszer'),
                0.5,
            ],
            'So ek to g'              => [
                new Hozzavalo('Só', 1, Mertekegyseg::EK, 'Fűszer'),
                new Hozzavalo('Só', 0, Mertekegyseg::G, 'Fűszer'),
                20.0,
            ],
            'So tk to g'              => [
                new Hozzavalo('Só', 1, Mertekegyseg::TK, 'Fűszer'),
                new Hozzavalo('Só', 0, Mertekegyseg::G, 'Fűszer'),
                8.0,
            ],
            'So kvk to g'             => [
                new Hozzavalo('Só', 1, Mertekegyseg::KVK, 'Fűszer'),
                new Hozzavalo('Só', 0, Mertekegyseg::G, 'Fűszer'),
                2.0,
            ],
            'So kk to g'              => [
                new Hozzavalo(
                    name:         'Só',
                    mennyiseg:    1,
                    mertekegyseg: Mertekegyseg::KK,
                    kategoria:    'Fűszer',
                ),
                new Hozzavalo(
                    name:         'Só',
                    mennyiseg:    0,
                    mertekegyseg: Mertekegyseg::G,
                    kategoria:    'Fűszer',
                ),
                2.0,
            ],
        ];
    }

    #[Test]
    public function testNemValt(): void
    {
        $hozzavalo           = new Hozzavalo(
            name:         'Csirkemell',
            mennyiseg:    10,
            mertekegyseg: Mertekegyseg::GEREZD,
            kategoria:    'Hús',
        );
        $hozzaadottHozzavalo = new Hozzavalo(
            name:         'Csirkemell',
            mennyiseg:    10,
            mertekegyseg: Mertekegyseg::TK,
            kategoria:    'Hús',
        );

        $this->expectException(UnknownUnitOfMeasureException::class);
        $this->expectExceptionMessage(sprintf('Cannot convert %s to %s', $hozzavalo, $hozzaadottHozzavalo));

        $this->sut->valt($hozzavalo, $hozzaadottHozzavalo);
    }
}
