<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Mertekegyseg\Atvaltas;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\MertekegysegAtvalto;
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
    public function testValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo, float $expectedMennyiseg): void
    {
        $this->assertEquals($expectedMennyiseg, $this->sut->valt($hozzavalo, $hozzaadottHozzavalo));
    }

    public static function mertekegysegDataProvider(): array
    {
        return [
            'csirkemell db to dkg'    => [
                new Ingredient('Csirkemell', 1, Measure::DB, 'Hús'),
                new Ingredient('Csirkemell', 0, Measure::DKG, 'Hús'),
                25.0,
            ],
            'csirkemell db to kg'     => [
                new Ingredient('Csirkemell', 1, Measure::DB, 'Hús'),
                new Ingredient('Csirkemell', 0, Measure::KG, 'Hús'),
                0.25,
            ],
            'csirkemell dkg to db'    => [
                new Ingredient('Csirkemell', 25, Measure::DKG, 'Hús'),
                new Ingredient('Csirkemell', 0, Measure::DB, 'Hús'),
                1.0,
            ],
            'csirkemell kg to db'     => [
                new Ingredient('Csirkemell', 1, Measure::KG, 'Hús'),
                new Ingredient('Csirkemell', 0, Measure::DB, 'Hús'),
                4.0,
            ],
            'bogre to ml'             => [
                new Ingredient('Napraforgó olaj', 1, Measure::BOGRE, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                250.0,
            ],
            'cl to dl'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::CL, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::DL, 'Olaj'),
                0.1,
            ],
            'cl to l'                 => [
                new Ingredient('Napraforgó olaj', 1, Measure::CL, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::L, 'Olaj'),
                0.01,
            ],
            'cl to ml'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::CL, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                10.0,
            ],
            'csesze to ml'            => [
                new Ingredient('Napraforgó olaj', 1, Measure::CSESZE, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                250.0,
            ],
            'dl to l'                 => [
                new Ingredient('Napraforgó olaj', 1, Measure::DL, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::L, 'Olaj'),
                0.1,
            ],
            'dl to cl'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::DL, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::CL, 'Olaj'),
                10.0,
            ],
            'dl to ml'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::DL, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                100.0,
            ],
            'l to cl'                 => [
                new Ingredient('Napraforgó olaj', 1, Measure::L, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::CL, 'Olaj'),
                100.0,
            ],
            'l to dl'                 => [
                new Ingredient('Napraforgó olaj', 1, Measure::L, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::DL, 'Olaj'),
                10.0,
            ],
            'l to ml'                 => [
                new Ingredient('Napraforgó olaj', 1, Measure::L, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                1000.0,
            ],
            'ml to cl'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::ML, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::CL, 'Olaj'),
                0.1,
            ],
            'ml to dl'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::ML, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::DL, 'Olaj'),
                0.01,
            ],
            'ml to l'                 => [
                new Ingredient('Napraforgó olaj', 1, Measure::ML, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::L, 'Olaj'),
                0.001,
            ],
            'dkg to g'                => [
                new Ingredient('Csirkemell', 1, Measure::DKG, 'Hús'),
                new Ingredient('Csirkemell', 0, Measure::G, 'Hús'),
                10.0,
            ],
            'dkg to kg'               => [
                new Ingredient('Csirkemell', 1, Measure::DKG, 'Hús'),
                new Ingredient('Csirkemell', 0, Measure::KG, 'Hús'),
                0.01,
            ],
            'g to dkg'                => [
                new Ingredient('Csirkemell', 1, Measure::G, 'Hús'),
                new Ingredient('Csirkemell', 0, Measure::DKG, 'Hús'),
                0.1,
            ],
            'g to kg'                 => [
                new Ingredient('Csirkemell', 1, Measure::G, 'Hús'),
                new Ingredient('Csirkemell', 0, Measure::KG, 'Hús'),
                0.001,
            ],
            'kg to dkg'               => [
                new Ingredient('Csirkemell', 1, Measure::KG, 'Hús'),
                new Ingredient('Csirkemell', 0, Measure::DKG, 'Hús'),
                100.0,
            ],
            'kg to g'                 => [
                new Ingredient('Csirkemell', 1, Measure::KG, 'Hús'),
                new Ingredient('Csirkemell', 0, Measure::G, 'Hús'),
                1000.0,
            ],
            'ek to dl'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::EK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::DL, 'Olaj'),
                0.15,
            ],
            'ek to kvk'               => [
                new Ingredient('Napraforgó olaj', 1, Measure::EK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 3, Measure::KVK, 'Olaj'),
                15.0 / 5.0,
            ],
            'ek to kk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::EK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 3, Measure::KK, 'Olaj'),
                15.0 / 5.0,
            ],
            'ek to l'                 => [
                new Ingredient('Napraforgó olaj', 1, Measure::EK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::L, 'Olaj'),
                0.015,
            ],
            'ek to ml'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::EK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                15.0,
            ],
            'ek to mk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::EK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::MK, 'Olaj'),
                15.0 / 2.0,
            ],
            'ek to tk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::EK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 3, Measure::TK, 'Olaj'),
                15.0 / 5.0,
            ],
            'kvk to ek'               => [
                new Ingredient('Napraforgó olaj', 1, Measure::KVK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::EK, 'Olaj'),
                5.0 / 15.0,
            ],
            'kvk to kk'               => [
                new Ingredient('Napraforgó olaj', 1, Measure::KVK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::KK, 'Olaj'),
                1.0,
            ],
            'kvk to l'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::KVK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::L, 'Olaj'),
                0.005,
            ],
            'kvk to ml'               => [
                new Ingredient('Napraforgó olaj', 1, Measure::KVK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                5.0,
            ],
            'kvk to mk'               => [
                new Ingredient('Napraforgó olaj', 1, Measure::KVK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::MK, 'Olaj'),
                5.0 / 2.0,
            ],
            'kvk to tk'               => [
                new Ingredient('Napraforgó olaj', 1, Measure::KVK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 3, Measure::TK, 'Olaj'),
                1.0,
            ],
            'kk to ek'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::KK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::EK, 'Olaj'),
                5.0 / 15.0,
            ],
            'kk to kvk'               => [
                new Ingredient('Napraforgó olaj', 1, Measure::KK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::KVK, 'Olaj'),
                1.0,
            ],
            'kk to l'                 => [
                new Ingredient('Napraforgó olaj', 1, Measure::KK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::L, 'Olaj'),
                0.005,
            ],
            'kk to ml'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::KK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                5.0,
            ],
            'kk to mk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::KK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::MK, 'Olaj'),
                5.0 / 2.0,
            ],
            'kk to tk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::KK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::TK, 'Olaj'),
                1.0,
            ],
            'ml to ek'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::ML, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::EK, 'Olaj'),
                1 / 15.0,
            ],
            'ml to kvk'               => [
                new Ingredient('Napraforgó olaj', 1, Measure::ML, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::KVK, 'Olaj'),
                0.2,
            ],
            'ml to kk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::ML, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::KK, 'Olaj'),
                0.2,
            ],
            'ml to mk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::ML, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::MK, 'Olaj'),
                0.5,
            ],
            'ml to tk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::ML, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::TK, 'Olaj'),
                0.2,
            ],
            'ml to csepp'             => [
                new Ingredient('Napraforgó olaj', 1, Measure::ML, 'Olaj'),
                new Ingredient('Napraforgó olaj', 20, Measure::CSEPP, 'Olaj'),
                20.0,
            ],
            'csepp to ml'             => [
                new Ingredient('Napraforgó olaj', 1, Measure::CSEPP, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                0.05,
            ],
            'mk to ek'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::MK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::EK, 'Olaj'),
                2.0 / 15.0,
            ],
            'mk to kvk'               => [
                new Ingredient('Napraforgó olaj', 1, Measure::MK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::KVK, 'Olaj'),
                2.0 / 5.0,
            ],
            'mk to kk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::MK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::KK, 'Olaj'),
                2.0 / 5.0,
            ],
            'mk to l'                 => [
                new Ingredient('Napraforgó olaj', 1, Measure::MK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::L, 'Olaj'),
                0.002,
            ],
            'mk to ml'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::MK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                2.0,
            ],
            'mk to tk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::MK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::TK, 'Olaj'),
                2.0 / 5.0,
            ],
            'tk to dl'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::TK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::DL, 'Olaj'),
                0.05,
            ],
            'tk to ek'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::TK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0.3, Measure::EK, 'Olaj'),
                5.0 / 15.0,
            ],
            'tk to kvk'               => [
                new Ingredient('Napraforgó olaj', 1, Measure::TK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0.3, Measure::KVK, 'Olaj'),
                1.0,
            ],
            'tk to kk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::TK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0.3, Measure::KK, 'Olaj'),
                1.0,
            ],
            'tk to l'                 => [
                new Ingredient('Napraforgó olaj', 1, Measure::TK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::L, 'Olaj'),
                0.005,
            ],
            'tk to ml'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::TK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0, Measure::ML, 'Olaj'),
                5.0,
            ],
            'tk to mk'                => [
                new Ingredient('Napraforgó olaj', 1, Measure::TK, 'Olaj'),
                new Ingredient('Napraforgó olaj', 0.3, Measure::MK, 'Olaj'),
                5.0 / 2.0,
            ],
            'finomliszt bogre to dkg' => [
                new Ingredient('Finomliszt', 1, Measure::BOGRE, 'Sütés / Sütemény'),
                new Ingredient('Finomliszt', 0, Measure::DKG, 'Sütés / Sütemény'),
                15.0,
            ],
            'finomliszt bogre to g'   => [
                new Ingredient('Finomliszt', 1, Measure::BOGRE, 'Sütés / Sütemény'),
                new Ingredient('Finomliszt', 0, Measure::G, 'Sütés / Sütemény'),
                150.0,
            ],
            'finomliszt bogre to kg'  => [
                new Ingredient('Finomliszt', 1, Measure::BOGRE, 'Sütés / Sütemény'),
                new Ingredient('Finomliszt', 0, Measure::KG, 'Sütés / Sütemény'),
                0.15,
            ],
            'finomliszt ek to dkg'    => [
                new Ingredient('Finomliszt', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Finomliszt', 0, Measure::DKG, 'Sütés / Sütemény'),
                2.0,
            ],
            'finomliszt ek to g'      => [
                new Ingredient('Finomliszt', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Finomliszt', 0, Measure::G, 'Sütés / Sütemény'),
                20.0,
            ],
            'finomliszt ek to kg'     => [
                new Ingredient('Finomliszt', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Finomliszt', 0, Measure::KG, 'Sütés / Sütemény'),
                0.02,
            ],
            'liszt bogre to dkg'      => [
                new Ingredient('Liszt', 1, Measure::BOGRE, 'Sütés / Sütemény'),
                new Ingredient('Liszt', 0, Measure::DKG, 'Sütés / Sütemény'),
                15.0,
            ],
            'liszt bogre to g'        => [
                new Ingredient('Liszt', 1, Measure::BOGRE, 'Sütés / Sütemény'),
                new Ingredient('Liszt', 0, Measure::G, 'Sütés / Sütemény'),
                150.0,
            ],
            'liszt bogre to kg'       => [
                new Ingredient('Liszt', 1, Measure::BOGRE, 'Sütés / Sütemény'),
                new Ingredient('Liszt', 0, Measure::KG, 'Sütés / Sütemény'),
                0.15,
            ],
            'liszt ek to dkg'         => [
                new Ingredient('Liszt', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Liszt', 0, Measure::DKG, 'Sütés / Sütemény'),
                2.0,
            ],
            'liszt ek to g'           => [
                new Ingredient('Liszt', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Liszt', 0, Measure::G, 'Sütés / Sütemény'),
                20.0,
            ],
            'liszt ek to kg'          => [
                new Ingredient('Liszt', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Liszt', 0, Measure::KG, 'Sütés / Sütemény'),
                0.02,
            ],
            'porcukor ek to dkg'      => [
                new Ingredient('Porcukor', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Porcukor', 0, Measure::DKG, 'Sütés / Sütemény'),
                2.0,
            ],
            'porcukor ek to g'        => [
                new Ingredient('Porcukor', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Porcukor', 0, Measure::G, 'Sütés / Sütemény'),
                20.0,
            ],
            'porcukor ek to kg'       => [
                new Ingredient('Porcukor', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Porcukor', 0, Measure::KG, 'Sütés / Sütemény'),
                0.02,
            ],
            'cukor ek to dkg'         => [
                new Ingredient('Cukor', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Cukor', 0, Measure::DKG, 'Sütés / Sütemény'),
                2.0,
            ],
            'cukor ek to g'           => [
                new Ingredient('Cukor', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Cukor', 0, Measure::G, 'Sütés / Sütemény'),
                20.0,
            ],
            'cukor ek to kg'          => [
                new Ingredient('Cukor', 1, Measure::EK, 'Sütés / Sütemény'),
                new Ingredient('Cukor', 0, Measure::KG, 'Sütés / Sütemény'),
                0.02,
            ],
            'cukor mk to dkg'         => [
                new Ingredient('Cukor', 1, Measure::MK, 'Sütés / Sütemény'),
                new Ingredient('Cukor', 0, Measure::DKG, 'Sütés / Sütemény'),
                0.2,
            ],
            'cukor mk to g'           => [
                new Ingredient('Cukor', 1, Measure::MK, 'Sütés / Sütemény'),
                new Ingredient('Cukor', 0, Measure::G, 'Sütés / Sütemény'),
                2.0,
            ],
            'cukor mk to kg'          => [
                new Ingredient('Cukor', 1, Measure::MK, 'Sütés / Sütemény'),
                new Ingredient('Cukor', 0, Measure::KG, 'Sütés / Sütemény'),
                0.002,
            ],
            'cukor tk to dkg'         => [
                new Ingredient('Cukor', 1, Measure::TK, 'Sütés / Sütemény'),
                new Ingredient('Cukor', 0, Measure::DKG, 'Sütés / Sütemény'),
                0.6,
            ],
            'cukor tk to g'           => [
                new Ingredient('Cukor', 1, Measure::TK, 'Sütés / Sütemény'),
                new Ingredient('Cukor', 0, Measure::G, 'Sütés / Sütemény'),
                6.0,
            ],
            'cukor tk to kg'          => [
                new Ingredient('Cukor', 1, Measure::TK, 'Sütés / Sütemény'),
                new Ingredient('Cukor', 0, Measure::KG, 'Sütés / Sütemény'),
                0.006,
            ],
            'kukorica konzerv to g'   => [
                new Ingredient('Kukorica (konzerv)', 1, Measure::KONZERV, 'Tartós élelmiszer'),
                new Ingredient('Kukorica (konzerv)', 0, Measure::G, 'Tartós élelmiszer'),
                140.0,
            ],
            'vorosbab konzerv to g'   => [
                new Ingredient('Vörösbab (konzerv)', 1, Measure::KONZERV, 'Tartós élelmiszer'),
                new Ingredient('Vörösbab (konzerv)', 0, Measure::G, 'Tartós élelmiszer'),
                250.0,
            ],
            'tejfol ml to g'          => [
                new Ingredient('Tejföl', 1, Measure::ML, 'Tejtermék'),
                new Ingredient('Tejföl', 0, Measure::G, 'Tejtermék'),
                0.1,
            ],
            'tejfol cl to g'          => [
                new Ingredient('Tejföl', 1, Measure::CL, 'Tejtermék'),
                new Ingredient('Tejföl', 0, Measure::G, 'Tejtermék'),
                1.0,
            ],
            'tejfol dl to g'          => [
                new Ingredient('Tejföl', 1, Measure::DL, 'Tejtermék'),
                new Ingredient('Tejföl', 0, Measure::G, 'Tejtermék'),
                10.0,
            ],
            'So csipet to g'          => [
                new Ingredient('Só', 1, Measure::CSIPET, 'Fűszer'),
                new Ingredient('Só', 0, Measure::G, 'Fűszer'),
                0.5,
            ],
            'So ek to g'              => [
                new Ingredient('Só', 1, Measure::EK, 'Fűszer'),
                new Ingredient('Só', 0, Measure::G, 'Fűszer'),
                20.0,
            ],
            'So tk to g'              => [
                new Ingredient('Só', 1, Measure::TK, 'Fűszer'),
                new Ingredient('Só', 0, Measure::G, 'Fűszer'),
                8.0,
            ],
            'So kvk to g'             => [
                new Ingredient('Só', 1, Measure::KVK, 'Fűszer'),
                new Ingredient('Só', 0, Measure::G, 'Fűszer'),
                2.0,
            ],
            'So kk to g'              => [
                new Ingredient(
                    name:     'Só',
                    portion:  1,
                    measure:  Measure::KK,
                    category: 'Fűszer',
                ),
                new Ingredient(
                    name:     'Só',
                    portion:  0,
                    measure:  Measure::G,
                    category: 'Fűszer',
                ),
                2.0,
            ],
        ];
    }

    #[Test]
    public function testNemValt(): void
    {
        $hozzavalo           = new Ingredient(
            name:     'Csirkemell',
            portion:  10,
            measure:  Measure::GEREZD,
            category: 'Hús',
        );
        $hozzaadottHozzavalo = new Ingredient(
            name:     'Csirkemell',
            portion:  10,
            measure:  Measure::TK,
            category: 'Hús',
        );

        $this->expectException(UnknownUnitOfMeasureException::class);
        $this->expectExceptionMessage(sprintf('Cannot convert %s to %s', $hozzavalo, $hozzaadottHozzavalo));

        $this->sut->valt($hozzavalo, $hozzaadottHozzavalo);
    }
}
