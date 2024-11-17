<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Mertekegyseg\Atvaltas;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
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
    public function testValt(IngredientForFood $hozzavalo, IngredientForFood $hozzaadottHozzavalo, float $expectedMennyiseg): void
    {
        $this->assertEquals($expectedMennyiseg, $this->sut->valt($hozzavalo, $hozzaadottHozzavalo));
    }

    public static function mertekegysegDataProvider(): array
    {
        return [
            'csirkemell db to dkg'    => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::DB),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::DKG),
                25.0,
            ],
            'csirkemell db to kg'     => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::DB),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::KG),
                0.25,
            ],
            'csirkemell dkg to db'    => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 25, measure: Measure::DKG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::DB),
                1.0,
            ],
            'csirkemell kg to db'     => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::KG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::DB),
                4.0,
            ],
            'bogre to ml'             => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                250.0,
            ],
            'cl to dl'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::CL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::DL),
                0.1,
            ],
            'cl to l'                 => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::CL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                0.01,
            ],
            'cl to ml'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::CL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                10.0,
            ],
            'csesze to ml'            => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::CSESZE),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                250.0,
            ],
            'dl to l'                 => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                0.1,
            ],
            'dl to cl'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::CL),
                10.0,
            ],
            'dl to ml'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                100.0,
            ],
            'l to cl'                 => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::CL),
                100.0,
            ],
            'l to dl'                 => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::DL),
                10.0,
            ],
            'l to ml'                 => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                1000.0,
            ],
            'ml to cl'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::CL),
                0.1,
            ],
            'ml to dl'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::DL),
                0.01,
            ],
            'ml to l'                 => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                0.001,
            ],
            'dkg to g'                => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::DKG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::G),
                10.0,
            ],
            'dkg to kg'               => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::DKG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::KG),
                0.01,
            ],
            'g to dkg'                => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::G),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::DKG),
                0.1,
            ],
            'g to kg'                 => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::G),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::KG),
                0.001,
            ],
            'kg to dkg'               => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::KG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::DKG),
                100.0,
            ],
            'kg to g'                 => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::KG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::G),
                1000.0,
            ],
            'ek to dl'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::DL),
                0.15,
            ],
            'ek to kvk'               => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 3, measure: Measure::KVK),
                15.0 / 5.0,
            ],
            'ek to kk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 3, measure: Measure::KK),
                15.0 / 5.0,
            ],
            'ek to l'                 => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                0.015,
            ],
            'ek to ml'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                15.0,
            ],
            'ek to mk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::MK),
                15.0 / 2.0,
            ],
            'ek to tk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 3, measure: Measure::TK),
                15.0 / 5.0,
            ],
            'kvk to ek'               => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::EK),
                5.0 / 15.0,
            ],
            'kvk to kk'               => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KK),
                1.0,
            ],
            'kvk to l'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                0.005,
            ],
            'kvk to ml'               => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                5.0,
            ],
            'kvk to mk'               => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::MK),
                5.0 / 2.0,
            ],
            'kvk to tk'               => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 3, measure: Measure::TK),
                1.0,
            ],
            'kk to ek'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::EK),
                5.0 / 15.0,
            ],
            'kk to kvk'               => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KVK),
                1.0,
            ],
            'kk to l'                 => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                0.005,
            ],
            'kk to ml'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                5.0,
            ],
            'kk to mk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::MK),
                5.0 / 2.0,
            ],
            'kk to tk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::TK),
                1.0,
            ],
            'ml to ek'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::EK),
                1 / 15.0,
            ],
            'ml to kvk'               => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KVK),
                0.2,
            ],
            'ml to kk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KK),
                0.2,
            ],
            'ml to mk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::MK),
                0.5,
            ],
            'ml to tk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::TK),
                0.2,
            ],
            'ml to csepp'             => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 20, measure: Measure::CSEPP),
                20.0,
            ],
            'csepp to ml'             => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::CSEPP),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                0.05,
            ],
            'mk to ek'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::EK),
                2.0 / 15.0,
            ],
            'mk to kvk'               => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KVK),
                2.0 / 5.0,
            ],
            'mk to kk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KK),
                2.0 / 5.0,
            ],
            'mk to l'                 => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                0.002,
            ],
            'mk to ml'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                2.0,
            ],
            'mk to tk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::TK),
                2.0 / 5.0,
            ],
            'tk to dl'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::DL),
                0.05,
            ],
            'tk to ek'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.3, measure: Measure::EK),
                5.0 / 15.0,
            ],
            'tk to kvk'               => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.3, measure: Measure::KVK),
                1.0,
            ],
            'tk to kk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.3, measure: Measure::KK),
                1.0,
            ],
            'tk to l'                 => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                0.005,
            ],
            'tk to ml'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                5.0,
            ],
            'tk to mk'                => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.3, measure: Measure::MK),
                5.0 / 2.0,
            ],
            'finomliszt bogre to dkg' => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                15.0,
            ],
            'finomliszt bogre to g'   => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                150.0,
            ],
            'finomliszt bogre to kg'  => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                0.15,
            ],
            'finomliszt ek to dkg'    => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                2.0,
            ],
            'finomliszt ek to g'      => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                20.0,
            ],
            'finomliszt ek to kg'     => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                0.02,
            ],
            'liszt bogre to dkg'      => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                15.0,
            ],
            'liszt bogre to g'        => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                150.0,
            ],
            'liszt bogre to kg'       => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                0.15,
            ],
            'liszt ek to dkg'         => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                2.0,
            ],
            'liszt ek to g'           => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                20.0,
            ],
            'liszt ek to kg'          => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                0.02,
            ],
            'porcukor ek to dkg'      => [
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                2.0,
            ],
            'porcukor ek to g'        => [
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                20.0,
            ],
            'porcukor ek to kg'       => [
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                0.02,
            ],
            'cukor ek to dkg'         => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                2.0,
            ],
            'cukor ek to g'           => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                20.0,
            ],
            'cukor ek to kg'          => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                0.02,
            ],
            'cukor mk to dkg'         => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                0.2,
            ],
            'cukor mk to g'           => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                2.0,
            ],
            'cukor mk to kg'          => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                0.002,
            ],
            'cukor tk to dkg'         => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                0.6,
            ],
            'cukor tk to g'           => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                6.0,
            ],
            'cukor tk to kg'          => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                0.006,
            ],
            'kukorica konzerv to g'   => [
                new IngredientForFood(name: 'Kukorica (konzerv)', category: 'Tartós élelmiszer', portion: 1, measure: Measure::KONZERV),
                new IngredientForFood(name: 'Kukorica (konzerv)', category: 'Tartós élelmiszer', portion: 0, measure: Measure::G),
                140.0,
            ],
            'vorosbab konzerv to g'   => [
                new IngredientForFood(name: 'Vörösbab (konzerv)', category: 'Tartós élelmiszer', portion: 1, measure: Measure::KONZERV),
                new IngredientForFood(name: 'Vörösbab (konzerv)', category: 'Tartós élelmiszer', portion: 0, measure: Measure::G),
                250.0,
            ],
            'tejfol ml to g'          => [
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 0, measure: Measure::G),
                0.1,
            ],
            'tejfol cl to g'          => [
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 1, measure: Measure::CL),
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 0, measure: Measure::G),
                1.0,
            ],
            'tejfol dl to g'          => [
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 1, measure: Measure::DL),
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 0, measure: Measure::G),
                10.0,
            ],
            'So csipet to g'          => [
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 1, measure: Measure::CSIPET),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0, measure: Measure::G),
                0.5,
            ],
            'So ek to g'              => [
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0, measure: Measure::G),
                20.0,
            ],
            'So tk to g'              => [
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0, measure: Measure::G),
                8.0,
            ],
            'So kvk to g'             => [
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0, measure: Measure::G),
                2.0,
            ],
            'So kk to g'              => [
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0, measure: Measure::G),
                2.0,
            ],
        ];
    }

    #[Test]
    public function testNemValt(): void
    {
        $ingredientForFood           = new IngredientForFood(
            name:     'Csirkemell',
            category: 'Hús',
            portion:  10,
            measure:  Measure::GEREZD
        );
        $additionalIngredientForFood = new IngredientForFood(
            name:     'Csirkemell',
            category: 'Hús',
            portion:  10,
            measure:  Measure::TK
        );

        $this->expectException(UnknownUnitOfMeasureException::class);
        $this->expectExceptionMessage(sprintf('Cannot convert %s to %s', $ingredientForFood, $additionalIngredientForFood));

        $this->sut->valt($ingredientForFood, $additionalIngredientForFood);
    }
}
