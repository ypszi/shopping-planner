<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Mertekegyseg\Atvaltas;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
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
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::DB, HozzavaloKategoria::HUS),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::DKG, HozzavaloKategoria::HUS),
                25.0,
            ],
            'csirkemell db to kg'     => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::DB, HozzavaloKategoria::HUS),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::KG, HozzavaloKategoria::HUS),
                0.25,
            ],
            'csirkemell dkg to db'    => [
                new Hozzavalo('Csirkemell', 25, Mertekegyseg::DKG, HozzavaloKategoria::HUS),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::DB, HozzavaloKategoria::HUS),
                1.0,
            ],
            // TODO: convert to Hozzavalo [peter.pecosz]
            'csirkemell kg to db'     => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::KG, HozzavaloKategoria::HUS),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::DB, HozzavaloKategoria::HUS),
                4.0,
            ],
            'bogre to ml'             => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::BOGRE, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                250.0,
            ],
            'cl to dl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::CL, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::DL, HozzavaloKategoria::OLAJ),
                0.1,
            ],
            'cl to l'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::CL, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, HozzavaloKategoria::OLAJ),
                0.01,
            ],
            'cl to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::CL, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                10.0,
            ],
            'csesze to ml'            => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::CSESZE, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                250.0,
            ],
            'dl to l'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::DL, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, HozzavaloKategoria::OLAJ),
                0.1,
            ],
            'dl to cl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::DL, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::CL, HozzavaloKategoria::OLAJ),
                10.0,
            ],
            'dl to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::DL, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                100.0,
            ],
            'l to cl'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::L, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::CL, HozzavaloKategoria::OLAJ),
                100.0,
            ],
            'l to dl'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::L, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::DL, HozzavaloKategoria::OLAJ),
                10.0,
            ],
            'l to ml'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::L, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                1000.0,
            ],
            'ml to cl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::CL, HozzavaloKategoria::OLAJ),
                0.1,
            ],
            'ml to dl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::DL, HozzavaloKategoria::OLAJ),
                0.01,
            ],
            'ml to l'                 => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::L, HozzavaloKategoria::OLAJ),
                0.001,
            ],
            'dkg to g'                => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::DKG, HozzavaloKategoria::HUS),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::G, HozzavaloKategoria::HUS),
                10.0,
            ],
            'dkg to kg'               => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::DKG, HozzavaloKategoria::HUS),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::KG, HozzavaloKategoria::HUS),
                0.01,
            ],
            'g to dkg'                => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::G, HozzavaloKategoria::HUS),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::DKG, HozzavaloKategoria::HUS),
                0.1,
            ],
            'g to kg'                 => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::G, HozzavaloKategoria::HUS),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::KG, HozzavaloKategoria::HUS),
                0.001,
            ],
            'kg to dkg'               => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::KG, HozzavaloKategoria::HUS),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::DKG, HozzavaloKategoria::HUS),
                100.0,
            ],
            'kg to g'                 => [
                new Hozzavalo('Csirkemell', 1, Mertekegyseg::KG, HozzavaloKategoria::HUS),
                new Hozzavalo('Csirkemell', 0, Mertekegyseg::G, HozzavaloKategoria::HUS),
                1000.0,
            ],
            'ek to dl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::DL, HozzavaloKategoria::OLAJ),
                0.15,
            ],
            'ek to kvk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 3, Mertekegyseg::KVK, HozzavaloKategoria::OLAJ),
                15.0 / 5.0,
            ],
            'ek to kk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 3, Mertekegyseg::KK, HozzavaloKategoria::OLAJ),
                15.0 / 5.0,
            ],
            'ek to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                15.0,
            ],
            'ek to mk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::MK, HozzavaloKategoria::OLAJ),
                15.0 / 2.0,
            ],
            'ek to tk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 3, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                15.0 / 5.0,
            ],
            'kvk to ek'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                5.0 / 15.0,
            ],
            'kvk to kk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KK, HozzavaloKategoria::OLAJ),
                1.0,
            ],
            'kvk to ml'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                5.0,
            ],
            'kvk to mk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::MK, HozzavaloKategoria::OLAJ),
                5.0 / 2.0,
            ],
            'kvk to tk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KVK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 3, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                1.0,
            ],
            'kk to ek'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                5.0 / 15.0,
            ],
            'kk to kvk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KVK, HozzavaloKategoria::OLAJ),
                1.0,
            ],
            'kk to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                5.0,
            ],
            'kk to mk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::MK, HozzavaloKategoria::OLAJ),
                5.0 / 2.0,
            ],
            'kk to tk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::KK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                1.0,
            ],
            'ml to ek'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                1 / 15.0,
            ],
            'ml to kvk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KVK, HozzavaloKategoria::OLAJ),
                0.2,
            ],
            'ml to kk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KK, HozzavaloKategoria::OLAJ),
                0.2,
            ],
            'ml to mk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::MK, HozzavaloKategoria::OLAJ),
                0.5,
            ],
            'ml to tk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                0.2,
            ],
            'ml to csepp'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 20, Mertekegyseg::CSEPP, HozzavaloKategoria::OLAJ),
                20.0,
            ],
            'csepp to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::CSEPP, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                0.05,
            ],
            'mk to ek'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                2.0 / 15.0,
            ],
            'mk to kvk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KVK, HozzavaloKategoria::OLAJ),
                2.0 / 5.0,
            ],
            'mk to kk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::KK, HozzavaloKategoria::OLAJ),
                2.0 / 5.0,
            ],
            'mk to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                2.0,
            ],
            'mk to tk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::MK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                2.0 / 5.0,
            ],
            'tk to dl'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::DL, HozzavaloKategoria::OLAJ),
                0.05,
            ],
            'tk to ek'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0.3, Mertekegyseg::EK, HozzavaloKategoria::OLAJ),
                5.0 / 15.0,
            ],
            'tk to kvk'               => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0.3, Mertekegyseg::KVK, HozzavaloKategoria::OLAJ),
                1.0,
            ],
            'tk to kk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0.3, Mertekegyseg::KK, HozzavaloKategoria::OLAJ),
                1.0,
            ],
            'tk to ml'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0, Mertekegyseg::ML, HozzavaloKategoria::OLAJ),
                5.0,
            ],
            'tk to mk'                => [
                new Hozzavalo('Napraforgó olaj', 1, Mertekegyseg::TK, HozzavaloKategoria::OLAJ),
                new Hozzavalo('Napraforgó olaj', 0.3, Mertekegyseg::MK, HozzavaloKategoria::OLAJ),
                5.0 / 2.0,
            ],
            // TODO: replace with Hozzavalo [peter.pecosz]
            'finomliszt bogre to dkg' => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::BOGRE, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::DKG, HozzavaloKategoria::CUKRASZ),
                15.0,
            ],
            'finomliszt bogre to g'   => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::BOGRE, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::G, HozzavaloKategoria::CUKRASZ),
                150.0,
            ],
            'finomliszt bogre to kg'  => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::BOGRE, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::KG, HozzavaloKategoria::CUKRASZ),
                0.15,
            ],
            'finomliszt ek to dkg'    => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::DKG, HozzavaloKategoria::CUKRASZ),
                2.0,
            ],
            'finomliszt ek to g'      => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::G, HozzavaloKategoria::CUKRASZ),
                20.0,
            ],
            'finomliszt ek to kg'     => [
                new Hozzavalo('Finomliszt', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Finomliszt', 0, Mertekegyseg::KG, HozzavaloKategoria::CUKRASZ),
                0.02,
            ],
            'liszt bogre to dkg'      => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::BOGRE, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Liszt', 0, Mertekegyseg::DKG, HozzavaloKategoria::CUKRASZ),
                15.0,
            ],
            'liszt bogre to g'        => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::BOGRE, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Liszt', 0, Mertekegyseg::G, HozzavaloKategoria::CUKRASZ),
                150.0,
            ],
            'liszt bogre to kg'       => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::BOGRE, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Liszt', 0, Mertekegyseg::KG, HozzavaloKategoria::CUKRASZ),
                0.15,
            ],
            'liszt ek to dkg'         => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Liszt', 0, Mertekegyseg::DKG, HozzavaloKategoria::CUKRASZ),
                2.0,
            ],
            'liszt ek to g'           => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Liszt', 0, Mertekegyseg::G, HozzavaloKategoria::CUKRASZ),
                20.0,
            ],
            'liszt ek to kg'          => [
                new Hozzavalo('Liszt', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Liszt', 0, Mertekegyseg::KG, HozzavaloKategoria::CUKRASZ),
                0.02,
            ],
            'porcukor ek to dkg'      => [
                new Hozzavalo('Porcukor', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Porcukor', 0, Mertekegyseg::DKG, HozzavaloKategoria::CUKRASZ),
                2.0,
            ],
            'porcukor ek to g'        => [
                new Hozzavalo('Porcukor', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Porcukor', 0, Mertekegyseg::G, HozzavaloKategoria::CUKRASZ),
                20.0,
            ],
            'porcukor ek to kg'       => [
                new Hozzavalo('Porcukor', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Porcukor', 0, Mertekegyseg::KG, HozzavaloKategoria::CUKRASZ),
                0.02,
            ],
            'cukor ek to dkg'         => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Cukor', 0, Mertekegyseg::DKG, HozzavaloKategoria::CUKRASZ),
                2.0,
            ],
            'cukor ek to g'           => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Cukor', 0, Mertekegyseg::G, HozzavaloKategoria::CUKRASZ),
                20.0,
            ],
            'cukor ek to kg'          => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::EK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Cukor', 0, Mertekegyseg::KG, HozzavaloKategoria::CUKRASZ),
                0.02,
            ],
            'cukor mk to dkg'         => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::MK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Cukor', 0, Mertekegyseg::DKG, HozzavaloKategoria::CUKRASZ),
                0.2,
            ],
            'cukor mk to g'           => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::MK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Cukor', 0, Mertekegyseg::G, HozzavaloKategoria::CUKRASZ),
                2.0,
            ],
            'cukor mk to kg'          => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::MK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Cukor', 0, Mertekegyseg::KG, HozzavaloKategoria::CUKRASZ),
                0.002,
            ],
            'cukor tk to dkg'         => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::TK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Cukor', 0, Mertekegyseg::DKG, HozzavaloKategoria::CUKRASZ),
                0.6,
            ],
            'cukor tk to g'           => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::TK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Cukor', 0, Mertekegyseg::G, HozzavaloKategoria::CUKRASZ),
                6.0,
            ],
            'cukor tk to kg'          => [
                new Hozzavalo('Cukor', 1, Mertekegyseg::TK, HozzavaloKategoria::CUKRASZ),
                new Hozzavalo('Cukor', 0, Mertekegyseg::KG, HozzavaloKategoria::CUKRASZ),
                0.006,
            ],
            'kukorica konzerv to g'   => [
                new Hozzavalo('Kukorica (konzerv)', 1, Mertekegyseg::KONZERV, HozzavaloKategoria::TARTOS_ELELMISZER),
                new Hozzavalo('Kukorica (konzerv)', 0, Mertekegyseg::G, HozzavaloKategoria::TARTOS_ELELMISZER),
                140.0,
            ],
            'vorosbab konzerv to g'   => [
                new Hozzavalo('Vörösbab (konzerv)', 1, Mertekegyseg::KONZERV, HozzavaloKategoria::TARTOS_ELELMISZER),
                new Hozzavalo('Vörösbab (konzerv)', 0, Mertekegyseg::G, HozzavaloKategoria::TARTOS_ELELMISZER),
                250.0,
            ],
            'tejfol ml to g'          => [
                new Hozzavalo('Tejföl', 1, Mertekegyseg::ML, HozzavaloKategoria::TEJTERMEK),
                new Hozzavalo('Tejföl', 0, Mertekegyseg::G, HozzavaloKategoria::TEJTERMEK),
                0.1,
            ],
            'tejfol cl to g'          => [
                new Hozzavalo('Tejföl', 1, Mertekegyseg::CL, HozzavaloKategoria::TEJTERMEK),
                new Hozzavalo('Tejföl', 0, Mertekegyseg::G, HozzavaloKategoria::TEJTERMEK),
                1.0,
            ],
            'tejfol dl to g'          => [
                new Hozzavalo('Tejföl', 1, Mertekegyseg::DL, HozzavaloKategoria::TEJTERMEK),
                new Hozzavalo('Tejföl', 0, Mertekegyseg::G, HozzavaloKategoria::TEJTERMEK),
                10.0,
            ],
            'So csipet to g'          => [
                new Hozzavalo('Só', 1, Mertekegyseg::CSIPET, HozzavaloKategoria::FUSZER),
                new Hozzavalo('Só', 0, Mertekegyseg::G, HozzavaloKategoria::FUSZER),
                0.5,
            ],
            'So ek to g'              => [
                new Hozzavalo('Só', 1, Mertekegyseg::EK, HozzavaloKategoria::FUSZER),
                new Hozzavalo('Só', 0, Mertekegyseg::G, HozzavaloKategoria::FUSZER),
                20.0,
            ],
            'So tk to g'              => [
                new Hozzavalo('Só', 1, Mertekegyseg::TK, HozzavaloKategoria::FUSZER),
                new Hozzavalo('Só', 0, Mertekegyseg::G, HozzavaloKategoria::FUSZER),
                8.0,
            ],
            'So kvk to g'             => [
                new Hozzavalo('Só', 1, Mertekegyseg::KVK, HozzavaloKategoria::FUSZER),
                new Hozzavalo('Só', 0, Mertekegyseg::G, HozzavaloKategoria::FUSZER),
                2.0,
            ],
            'So kk to g'              => [
                new Hozzavalo(
                    name:         'Só',
                    mennyiseg:    1,
                    mertekegyseg: Mertekegyseg::KK,
                    kategoria:    HozzavaloKategoria::FUSZER,
                ),
                new Hozzavalo(
                    name:         'Só',
                    mennyiseg:    0,
                    mertekegyseg: Mertekegyseg::G,
                    kategoria:    HozzavaloKategoria::FUSZER,
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
            kategoria:    HozzavaloKategoria::HUS,
        );
        $hozzaadottHozzavalo = new Hozzavalo(
            name:         'Csirkemell',
            mennyiseg:    10,
            mertekegyseg: Mertekegyseg::TK,
            kategoria:    HozzavaloKategoria::HUS,
        );

        $this->expectException(UnknownUnitOfMeasureException::class);
        $this->expectExceptionMessage(sprintf('Cannot convert %s to %s', $hozzavalo, $hozzaadottHozzavalo));

        $this->sut->valt($hozzavalo, $hozzaadottHozzavalo);
    }
}
