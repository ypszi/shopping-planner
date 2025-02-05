<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\ServiceProvider;

use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\ServiceDefinitionProviderInterface;
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
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\BogreToDekagram as FinomLisztBogreToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\BogreToGram as FinomLisztBogreToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\BogreToKilogram as FinomLisztBogreToKilogram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\EvokanalToDekagram as FinomLisztEvokanalToDekagram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\EvokanalToGram as FinomLisztEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt\EvokanalToKilogram as FinomLisztEvokanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal\DeciliterToEvoKanal;
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

use function DI\autowire;
use function DI\create;

class MeasureServiceProvider implements ServiceDefinitionProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            MeasureConversionCollection::class => create()
                ->constructor(
                    [
                        autowire(AlapleDeciliterToHuslevesKocka::class),
                        autowire(AlapleLiterToHuslevesKocka::class),
                        create(CsirkemellDarabToDekagram::class),
                        create(CsirkemellDarabToKilogram::class),
                        create(CsirkemellDekagramToDarab::class),
                        create(CsirkemellKilogramToDarab::class),
                        create(BogreToMilliliter::class),
                        create(CentiliterToDeciliter::class),
                        create(CentiliterToLiter::class),
                        create(CentiliterToMilliliter::class),
                        create(CseppToMilliliter::class),
                        create(CseszeToMilliliter::class),
                        create(DeciliterToEvoKanal::class),
                        create(DeciliterToLiter::class),
                        create(DeciliterToCentiliter::class),
                        create(DeciliterToMilliliter::class),
                        create(LiterToCentiliter::class),
                        create(LiterToDeciliter::class),
                        create(LiterToMilliliter::class),
                        create(MilliliterToCsepp::class),
                        create(MilliliterToCentiliter::class),
                        create(MilliliterToDeciliter::class),
                        create(MilliliterToLiter::class),
                        create(DekagramToGram::class),
                        create(DekagramToKilogram::class),
                        create(GramToDekagram::class),
                        create(GramToKilogram::class),
                        create(KilogramToDekagram::class),
                        create(KilogramToGram::class),
                        create(EvoKanalToDeciliter::class),
                        create(EvoKanalToKavesKanal::class),
                        create(EvoKanalToKisKanal::class),
                        create(EvoKanalToLiter::class),
                        create(EvoKanalToMilliliter::class),
                        create(EvoKanalToMokkasKanal::class),
                        create(EvoKanalToTeasKanal::class),
                        create(KavesKanalToEvoKanal::class),
                        create(KavesKanalToKisKanal::class),
                        create(KavesKanalToLiter::class),
                        create(KavesKanalToMilliliter::class),
                        create(KavesKanalToMokkasKanal::class),
                        create(KavesKanalToTeasKanal::class),
                        create(KisKanalToEvoKanal::class),
                        create(KisKanalToKavesKanal::class),
                        create(KisKanalToLiter::class),
                        create(KisKanalToMilliliter::class),
                        create(KisKanalToMokkasKanal::class),
                        create(KisKanalToTeasKanal::class),
                        create(MilliliterToEvoKanal::class),
                        create(MilliliterToKavesKanal::class),
                        create(MilliliterToKisKanal::class),
                        create(MilliliterToMokkasKanal::class),
                        create(MilliliterToTeasKanal::class),
                        create(MokkasKanalToEvoKanal::class),
                        create(MokkasKanalToKavesKanal::class),
                        create(MokkasKanalToKisKanal::class),
                        create(MokkasKanalToLiter::class),
                        create(MokkasKanalToMilliliter::class),
                        create(MokkasKanalToTeasKanal::class),
                        create(TeasKanalToDeciliter::class),
                        create(TeasKanalToEvokanal::class),
                        create(TeasKanalToKaveskanal::class),
                        create(TeasKanalToKiskanal::class),
                        create(TeasKanalToLiter::class),
                        create(TeasKanalToMilliliter::class),
                        create(TeasKanalToMokkaskanal::class),
                        create(FinomLisztBogreToDekagram::class),
                        create(FinomLisztBogreToGram::class),
                        create(FinomLisztBogreToKilogram::class),
                        create(FinomLisztEvokanalToDekagram::class),
                        create(FinomLisztEvokanalToGram::class),
                        create(FinomLisztEvokanalToKiloGram::class),
                        create(LisztBogreToDekagram::class),
                        create(LisztBogreToGram::class),
                        create(LisztBogreToKilogram::class),
                        create(LisztEvokanalToDekagram::class),
                        create(LisztEvokanalToGram::class),
                        create(LisztEvokanalToKiloGram::class),
                        create(PorcukorEvokanalToDekagram::class),
                        create(PorcukorEvokanalToGram::class),
                        create(PorcukorEvokanalToKiloGram::class),
                        create(CukorEvokanalToDekagram::class),
                        create(CukorEvokanalToGram::class),
                        create(CukorEvokanalToKiloGram::class),
                        create(CukorTeaskanalToDekagram::class),
                        create(CukorTeaskanalToGram::class),
                        create(CukorTeaskanalToKilogram::class),
                        create(CukorMokkaskanalToDekagram::class),
                        create(CukorMokkaskanalToGram::class),
                        create(CukorMokkaskanalToKiloGram::class),
                        create(KukoricaKonzervToGram::class),
                        create(VorosbabKonzervToGram::class),
                        create(TejfolMilliliterToGram::class),
                        create(TejfolCentiliterToGram::class),
                        create(TejfolDeciliterToGram::class),
                        create(SoCsipetToGram::class),
                        create(SoEvokanalToGram::class),
                        create(SoTeaskanalToGram::class),
                        create(SoKaveskanalToGram::class),
                        create(SoKiskanalToGram::class),
                    ]
                ),
        ];
    }
}
