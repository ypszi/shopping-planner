<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Measure\Conversion;

use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Alaple\AlapleDeciliterToHuslevesKocka;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Alaple\AlapleLiterToHuslevesKocka;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Csirkemell\DarabToDekagram as CsirkemellDarabToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Csirkemell\DarabToKilogram as CsirkemellDarabToKilogram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Csirkemell\DekagramToDarab as CsirkemellDekagramToDarab;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Csirkemell\KilogramToDarab as CsirkemellKilogramToDarab;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Cukor\EvokanalToDekagram as CukorEvokanalToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Cukor\EvokanalToGram as CukorEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Cukor\EvokanalToKilogram as CukorEvokanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Cukor\MokkaskanalToDekagram as CukorMokkaskanalToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Cukor\MokkaskanalToGram as CukorMokkaskanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Cukor\MokkaskanalToKilogram as CukorMokkaskanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Cukor\TeaskanalToDekagram as CukorTeaskanalToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Cukor\TeaskanalToGram as CukorTeaskanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Cukor\TeaskanalToKilogram as CukorTeaskanalToKilogram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\BogreToDekagram as FinomLisztBogreToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\BogreToGram as FinomLisztBogreToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\BogreToKilogram as FinomLisztBogreToKilogram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\EvokanalToDekagram as FinomLisztEvokanalToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\EvokanalToGram as FinomLisztEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\EvokanalToKilogram as FinomLisztEvokanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\EvoKanalToDeciliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\EvoKanalToKavesKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\EvoKanalToKisKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\EvoKanalToLiter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\EvoKanalToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\EvoKanalToMokkasKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\EvoKanalToTeasKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KavesKanalToEvoKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KavesKanalToKisKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KavesKanalToLiter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KavesKanalToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KavesKanalToMokkasKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KavesKanalToTeasKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KisKanalToEvoKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KisKanalToKavesKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KisKanalToLiter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KisKanalToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KisKanalToMokkasKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\KisKanalToTeasKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MilliliterToEvoKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MilliliterToKavesKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MilliliterToKisKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MilliliterToMokkasKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MilliliterToTeasKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MokkasKanalToEvoKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MokkasKanalToKavesKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MokkasKanalToKisKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MokkasKanalToLiter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MokkasKanalToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\MokkasKanalToTeasKanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\TeasKanalToDeciliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\TeasKanalToEvokanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\TeasKanalToKaveskanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\TeasKanalToKiskanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\TeasKanalToLiter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\TeasKanalToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\TeasKanalToMokkaskanal;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kukorica\KonzervToGram as KukoricaKonzervToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Liszt\BogreToDekagram as LisztBogreToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Liszt\BogreToGram as LisztBogreToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Liszt\BogreToKilogram as LisztBogreToKilogram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Liszt\EvokanalToDekagram as LisztEvokanalToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Liszt\EvokanalToGram as LisztEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Liszt\EvokanalToKilogram as LisztEvokanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversionCollection;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Porcukor\EvokanalToDekagram as PorcukorEvokanalToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Porcukor\EvokanalToGram as PorcukorEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Porcukor\EvokanalToKilogram as PorcukorEvokanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\So\CsipetToGram as SoCsipetToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\So\EvokanalToGram as SoEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\So\KaveskanalToGram as SoKaveskanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\So\KiskanalToGram as SoKiskanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\So\TeaskanalToGram as SoTeaskanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Tejfol\CentiliterToGram as TejfolCentiliterToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Tejfol\DeciliterToGram as TejfolDeciliterToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Tejfol\MilliliterToGram as TejfolMilliliterToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Tomeg\DekagramToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Tomeg\DekagramToKilogram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Tomeg\GramToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Tomeg\GramToKilogram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Tomeg\KilogramToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Tomeg\KilogramToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\BogreToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\CentiliterToDeciliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\CentiliterToLiter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\CentiliterToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\CseppToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\CseszeToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\DeciliterToCentiliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\DeciliterToLiter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\DeciliterToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\LiterToCentiliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\LiterToDeciliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\LiterToMilliliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\MilliliterToCentiliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\MilliliterToCsepp;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\MilliliterToDeciliter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Urtartalom\MilliliterToLiter;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Vorosbab\KonzervToGram as VorosbabKonzervToGram;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PeterPecosz\ShoppingPlanner\Measure\MeasureConverter;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MeasureConverterTest extends TestCase
{
    private MeasureConverter $sut;

    protected function setUp(): void
    {
        $ingredientFactory = new IngredientFactory(
            __DIR__ . '/../../../app/ingredients.yaml',
            __DIR__ . '/../../../app/ingredientCategories.yaml',
        );

        $this->sut = new MeasureConverter(
            new MeasureConversionCollection(
                [
                    new AlapleDeciliterToHuslevesKocka($ingredientFactory),
                    new AlapleLiterToHuslevesKocka($ingredientFactory),
                    new CsirkemellDarabToDekagram(),
                    new CsirkemellDarabToKilogram(),
                    new CsirkemellDekagramToDarab(),
                    new CsirkemellKilogramToDarab(),
                    new BogreToMilliliter(),
                    new CentiliterToDeciliter(),
                    new CentiliterToLiter(),
                    new CentiliterToMilliliter(),
                    new CseppToMilliliter(),
                    new CseszeToMilliliter(),
                    new DeciliterToLiter(),
                    new DeciliterToCentiliter(),
                    new DeciliterToMilliliter(),
                    new LiterToCentiliter(),
                    new LiterToDeciliter(),
                    new LiterToMilliliter(),
                    new MilliliterToCsepp(),
                    new MilliliterToCentiliter(),
                    new MilliliterToDeciliter(),
                    new MilliliterToLiter(),
                    new DekagramToGram(),
                    new DekagramToKilogram(),
                    new GramToDekagram(),
                    new GramToKilogram(),
                    new KilogramToDekagram(),
                    new KilogramToGram(),
                    new EvoKanalToDeciliter(),
                    new EvoKanalToKavesKanal(),
                    new EvoKanalToKisKanal(),
                    new EvoKanalToLiter(),
                    new EvoKanalToMilliliter(),
                    new EvoKanalToMokkasKanal(),
                    new EvoKanalToTeasKanal(),
                    new KavesKanalToEvoKanal(),
                    new KavesKanalToKisKanal(),
                    new KavesKanalToLiter(),
                    new KavesKanalToMilliliter(),
                    new KavesKanalToMokkasKanal(),
                    new KavesKanalToTeasKanal(),
                    new KisKanalToEvoKanal(),
                    new KisKanalToKavesKanal(),
                    new KisKanalToLiter(),
                    new KisKanalToMilliliter(),
                    new KisKanalToMokkasKanal(),
                    new KisKanalToTeasKanal(),
                    new MilliliterToEvoKanal(),
                    new MilliliterToKavesKanal(),
                    new MilliliterToKisKanal(),
                    new MilliliterToMokkasKanal(),
                    new MilliliterToTeasKanal(),
                    new MokkasKanalToEvoKanal(),
                    new MokkasKanalToKavesKanal(),
                    new MokkasKanalToKisKanal(),
                    new MokkasKanalToLiter(),
                    new MokkasKanalToMilliliter(),
                    new MokkasKanalToTeasKanal(),
                    new TeasKanalToDeciliter(),
                    new TeasKanalToEvokanal(),
                    new TeasKanalToKaveskanal(),
                    new TeasKanalToKiskanal(),
                    new TeasKanalToLiter(),
                    new TeasKanalToMilliliter(),
                    new TeasKanalToMokkaskanal(),
                    new FinomLisztBogreToDekagram(),
                    new FinomLisztBogreToGram(),
                    new FinomLisztBogreToKilogram(),
                    new FinomLisztEvokanalToDekagram(),
                    new FinomLisztEvokanalToGram(),
                    new FinomLisztEvokanalToKiloGram(),
                    new LisztBogreToDekagram(),
                    new LisztBogreToGram(),
                    new LisztBogreToKilogram(),
                    new LisztEvokanalToDekagram(),
                    new LisztEvokanalToGram(),
                    new LisztEvokanalToKiloGram(),
                    new PorcukorEvokanalToDekagram(),
                    new PorcukorEvokanalToGram(),
                    new PorcukorEvokanalToKiloGram(),
                    new CukorEvokanalToDekagram(),
                    new CukorEvokanalToGram(),
                    new CukorEvokanalToKiloGram(),
                    new CukorTeaskanalToDekagram(),
                    new CukorTeaskanalToGram(),
                    new CukorTeaskanalToKilogram(),
                    new CukorMokkaskanalToDekagram(),
                    new CukorMokkaskanalToGram(),
                    new CukorMokkaskanalToKiloGram(),
                    new KukoricaKonzervToGram(),
                    new VorosbabKonzervToGram(),
                    new TejfolMilliliterToGram(),
                    new TejfolCentiliterToGram(),
                    new TejfolDeciliterToGram(),
                    new SoCsipetToGram(),
                    new SoEvokanalToGram(),
                    new SoTeaskanalToGram(),
                    new SoKaveskanalToGram(),
                    new SoKiskanalToGram(),
                ]
            )
        );
    }

    #[Test]
    #[DataProvider('mertekegysegDataProvider')]
    public function testValt(IngredientForFood $hozzavalo, IngredientForFood $hozzaadottHozzavalo, IngredientForFood $expectedIngredient): void
    {
        $this->assertEquals($expectedIngredient, $this->sut->convert($hozzavalo, $hozzaadottHozzavalo));
    }

    public static function mertekegysegDataProvider(): array
    {
        return [
            'alaplé deciliter to húsleves kocka db' => [
                new IngredientForFood(name: 'Alaplé', category: 'Fűszer', portion: 5, measure: Measure::DL),
                new IngredientForFood(name: 'Alaplé', category: 'Fűszer', portion: 0, measure: Measure::DB),
                new IngredientForFood(name: 'Húsleves kocka', category: 'Fűszer', portion: 1, measure: Measure::DB, measurePreference: Measure::DB),
            ],
            'alaplé liter to húsleves kocka db' => [
                new IngredientForFood(name: 'Alaplé', category: 'Fűszer', portion: 1, measure: Measure::L),
                new IngredientForFood(name: 'Alaplé', category: 'Fűszer', portion: 0, measure: Measure::DB),
                new IngredientForFood(name: 'Húsleves kocka', category: 'Fűszer', portion: 2, measure: Measure::DB, measurePreference: Measure::DB),
            ],
            'csirkemell db to dkg'              => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::DB),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 25.0, measure: Measure::DKG),
            ],
            'csirkemell db to kg'               => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::DB),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0.25, measure: Measure::KG),
            ],
            'csirkemell dkg to db'              => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 25, measure: Measure::DKG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::DB),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1.0, measure: Measure::DB),
            ],
            'csirkemell kg to db'               => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::KG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::DB),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 4.0, measure: Measure::DB),
            ],
            'bogre to ml'                       => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 250.0, measure: Measure::ML),
            ],
            'cl to dl'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::CL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.1, measure: Measure::DL),
            ],
            'cl to l'                           => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::CL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.01, measure: Measure::L),
            ],
            'cl to ml'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::CL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 10.0, measure: Measure::ML),
            ],
            'csesze to ml'                      => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::CSESZE),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 250.0, measure: Measure::ML),
            ],
            'dl to l'                           => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.1, measure: Measure::L),
            ],
            'dl to cl'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::CL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 10.0, measure: Measure::CL),
            ],
            'dl to ml'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 100.0, measure: Measure::ML),
            ],
            'l to cl'                           => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::CL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 100.0, measure: Measure::CL),
            ],
            'l to dl'                           => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 10.0, measure: Measure::DL),
            ],
            'l to ml'                           => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1000.0, measure: Measure::ML),
            ],
            'ml to cl'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::CL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.1, measure: Measure::CL),
            ],
            'ml to dl'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.01, measure: Measure::DL),
            ],
            'ml to l'                           => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.001, measure: Measure::L),
            ],
            'dkg to g'                          => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::DKG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 10.0, measure: Measure::G),
            ],
            'dkg to kg'                         => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::DKG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0.01, measure: Measure::KG),
            ],
            'g to dkg'                          => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::G),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0.1, measure: Measure::DKG),
            ],
            'g to kg'                           => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::G),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0.001, measure: Measure::KG),
            ],
            'kg to dkg'                         => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::KG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 100.0, measure: Measure::DKG),
            ],
            'kg to g'                           => [
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1, measure: Measure::KG),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Csirkemell', category: 'Hús', portion: 1000.0, measure: Measure::G),
            ],
            'ek to dl'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.15, measure: Measure::DL),
            ],
            'ek to kvk'                         => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 3, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 15.0 / 5.0, measure: Measure::KVK),
            ],
            'ek to kk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 3, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 15.0 / 5.0, measure: Measure::KK),
            ],
            'ek to l'                           => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.015, measure: Measure::L),
            ],
            'ek to ml'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 15.0, measure: Measure::ML),
            ],
            'ek to mk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 15.0 / 2.0, measure: Measure::MK),
            ],
            'ek to tk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 3, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 15.0 / 5.0, measure: Measure::TK),
            ],
            'kvk to ek'                         => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 5.0 / 15.0, measure: Measure::EK),
            ],
            'kvk to kk'                         => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1.0, measure: Measure::KK),
            ],
            'kvk to l'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.005, measure: Measure::L),
            ],
            'kvk to ml'                         => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 5.0, measure: Measure::ML),
            ],
            'kvk to mk'                         => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 5.0 / 2.0, measure: Measure::MK),
            ],
            'kvk to tk'                         => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 3, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1.0, measure: Measure::TK),
            ],
            'kk to ek'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 5.0 / 15.0, measure: Measure::EK),
            ],
            'kk to kvk'                         => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1.0, measure: Measure::KVK),
            ],
            'kk to l'                           => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.005, measure: Measure::L),
            ],
            'kk to ml'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 5.0, measure: Measure::ML),
            ],
            'kk to mk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 5.0 / 2.0, measure: Measure::MK),
            ],
            'kk to tk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1.0, measure: Measure::TK),
            ],
            'ml to ek'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1 / 15.0, measure: Measure::EK),
            ],
            'ml to kvk'                         => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.2, measure: Measure::KVK),
            ],
            'ml to kk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.2, measure: Measure::KK),
            ],
            'ml to mk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.5, measure: Measure::MK),
            ],
            'ml to tk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.2, measure: Measure::TK),
            ],
            'ml to csepp'                       => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 20, measure: Measure::CSEPP),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 20.0, measure: Measure::CSEPP),
            ],
            'csepp to ml'                       => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::CSEPP),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.05, measure: Measure::ML),
            ],
            'mk to ek'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 2.0 / 15.0, measure: Measure::EK),
            ],
            'mk to kvk'                         => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 2.0 / 5.0, measure: Measure::KVK),
            ],
            'mk to kk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 2.0 / 5.0, measure: Measure::KK),
            ],
            'mk to l'                           => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.002, measure: Measure::L),
            ],
            'mk to ml'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 2.0, measure: Measure::ML),
            ],
            'mk to tk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 2.0 / 5.0, measure: Measure::TK),
            ],
            'tk to dl'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::DL),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.05, measure: Measure::DL),
            ],
            'tk to ek'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.3, measure: Measure::EK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 5.0 / 15.0, measure: Measure::EK),
            ],
            'tk to kvk'                         => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.3, measure: Measure::KVK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1.0, measure: Measure::KVK),
            ],
            'tk to kk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.3, measure: Measure::KK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1.0, measure: Measure::KK),
            ],
            'tk to l'                           => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::L),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.005, measure: Measure::L),
            ],
            'tk to ml'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0, measure: Measure::ML),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 5.0, measure: Measure::ML),
            ],
            'tk to mk'                          => [
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 0.3, measure: Measure::MK),
                new IngredientForFood(name: 'Napraforgóolaj', category: 'Olaj', portion: 5.0 / 2.0, measure: Measure::MK),
            ],
            'finomliszt bogre to dkg'           => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 15.0, measure: Measure::DKG),
            ],
            'finomliszt bogre to g'             => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 150.0, measure: Measure::G),
            ],
            'finomliszt bogre to kg'            => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0.15, measure: Measure::KG),
            ],
            'finomliszt ek to dkg'              => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 2.0, measure: Measure::DKG),
            ],
            'finomliszt ek to g'                => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 20.0, measure: Measure::G),
            ],
            'finomliszt ek to kg'               => [
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Finomliszt', category: 'Sütés / Sütemény', portion: 0.02, measure: Measure::KG),
            ],
            'liszt bogre to dkg'                => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 15.0, measure: Measure::DKG),
            ],
            'liszt bogre to g'                  => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 150.0, measure: Measure::G),
            ],
            'liszt bogre to kg'                 => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::BOGRE),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0.15, measure: Measure::KG),
            ],
            'liszt ek to dkg'                   => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 2.0, measure: Measure::DKG),
            ],
            'liszt ek to g'                     => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 20.0, measure: Measure::G),
            ],
            'liszt ek to kg'                    => [
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Liszt', category: 'Sütés / Sütemény', portion: 0.02, measure: Measure::KG),
            ],
            'porcukor ek to dkg'                => [
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 2.0, measure: Measure::DKG),
            ],
            'porcukor ek to g'                  => [
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 20.0, measure: Measure::G),
            ],
            'porcukor ek to kg'                 => [
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Porcukor', category: 'Sütés / Sütemény', portion: 0.02, measure: Measure::KG),
            ],
            'cukor ek to dkg'                   => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 2.0, measure: Measure::DKG),
            ],
            'cukor ek to g'                     => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 20.0, measure: Measure::G),
            ],
            'cukor ek to kg'                    => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0.02, measure: Measure::KG),
            ],
            'cukor mk to dkg'                   => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0.2, measure: Measure::DKG),
            ],
            'cukor mk to g'                     => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 2.0, measure: Measure::G),
            ],
            'cukor mk to kg'                    => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::MK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0.002, measure: Measure::KG),
            ],
            'cukor tk to dkg'                   => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::DKG),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0.6, measure: Measure::DKG),
            ],
            'cukor tk to g'                     => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 6.0, measure: Measure::G),
            ],
            'cukor tk to kg'                    => [
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0, measure: Measure::KG),
                new IngredientForFood(name: 'Cukor', category: 'Sütés / Sütemény', portion: 0.006, measure: Measure::KG),
            ],
            'kukorica konzerv to g'             => [
                new IngredientForFood(name: 'Kukorica (konzerv)', category: 'Tartós élelmiszer', portion: 1, measure: Measure::KONZERV),
                new IngredientForFood(name: 'Kukorica (konzerv)', category: 'Tartós élelmiszer', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Kukorica (konzerv)', category: 'Tartós élelmiszer', portion: 140.0, measure: Measure::G),
            ],
            'vorosbab konzerv to g'             => [
                new IngredientForFood(name: 'Vörösbab (konzerv)', category: 'Tartós élelmiszer', portion: 1, measure: Measure::KONZERV),
                new IngredientForFood(name: 'Vörösbab (konzerv)', category: 'Tartós élelmiszer', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Vörösbab (konzerv)', category: 'Tartós élelmiszer', portion: 250.0, measure: Measure::G),
            ],
            'tejfol ml to g'                    => [
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 1, measure: Measure::ML),
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 0.1, measure: Measure::G),
            ],
            'tejfol cl to g'                    => [
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 1, measure: Measure::CL),
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 1.0, measure: Measure::G),
            ],
            'tejfol dl to g'                    => [
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 1, measure: Measure::DL),
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Tejföl', category: 'Tejtermék', portion: 10.0, measure: Measure::G),
            ],
            'So csipet to g'                    => [
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 1, measure: Measure::CSIPET),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0.5, measure: Measure::G),
            ],
            'So ek to g'                        => [
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 1, measure: Measure::EK),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 20.0, measure: Measure::G),
            ],
            'So tk to g'                        => [
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 1, measure: Measure::TK),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 8.0, measure: Measure::G),
            ],
            'So kvk to g'                       => [
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 1, measure: Measure::KVK),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 2.0, measure: Measure::G),
            ],
            'So kk to g'                        => [
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 1, measure: Measure::KK),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 0, measure: Measure::G),
                new IngredientForFood(name: 'Só', category: 'Fűszer', portion: 2.0, measure: Measure::G),
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
        $this->expectExceptionMessage(sprintf('Cannot convert "%s" to "%s"', $ingredientForFood, $additionalIngredientForFood));

        $this->sut->convert($ingredientForFood, $additionalIngredientForFood);
    }
}
