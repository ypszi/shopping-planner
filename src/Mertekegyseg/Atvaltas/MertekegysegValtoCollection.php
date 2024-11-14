<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Csirkemell\DarabToDekagram as CsirkemellDarabToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Csirkemell\DarabToKilogram as CsirkemellDarabToKilogram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Csirkemell\DekagramToDarab as CsirkemellDekagramToDarab;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Csirkemell\KilogramToDarab as CsirkemellKilogramToDarab;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor\EvokanalToDekagram as CukorEvokanalToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor\EvokanalToGram as CukorEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor\EvokanalToKilogram as CukorEvokanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor\MokkaskanalToDekagram as CukorMokkaskanalToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor\MokkaskanalToGram as CukorMokkaskanalToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor\MokkaskanalToKilogram as CukorMokkaskanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor\TeaskanalToDekagram as CukorTeaskanalToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor\TeaskanalToGram as CukorTeaskanalToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor\TeaskanalToKilogram as CukorTeaskanalToKilogram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\FinomLiszt\BogreToDekagram as FinomLisztBogreToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\FinomLiszt\BogreToGram as FinomLisztBogreToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\FinomLiszt\BogreToKilogram as FinomLisztBogreToKilogram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\FinomLiszt\EvokanalToDekagram as FinomLisztEvokanalToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\FinomLiszt\EvokanalToGram as FinomLisztEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\FinomLiszt\EvokanalToKilogram as FinomLisztEvokanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\EvoKanalToDeciliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\EvoKanalToKavesKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\EvoKanalToKisKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\EvoKanalToLiter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\EvoKanalToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\EvoKanalToMokkasKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\EvoKanalToTeasKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KavesKanalToEvoKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KavesKanalToKisKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KavesKanalToLiter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KavesKanalToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KavesKanalToMokkasKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KavesKanalToTeasKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KisKanalToEvoKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KisKanalToKavesKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KisKanalToLiter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KisKanalToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KisKanalToMokkasKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\KisKanalToTeasKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MilliliterToEvoKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MilliliterToKavesKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MilliliterToKisKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MilliliterToMokkasKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MilliliterToTeasKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToEvoKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToKavesKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToKisKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToLiter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToTeasKanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\TeasKanalToDeciliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\TeasKanalToEvokanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\TeasKanalToKaveskanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\TeasKanalToKiskanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\TeasKanalToLiter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\TeasKanalToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal\TeasKanalToMokkaskanal;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kukorica\KonzervToGram as KukoricaKonzervToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Liszt\BogreToDekagram as LisztBogreToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Liszt\BogreToGram as LisztBogreToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Liszt\BogreToKilogram as LisztBogreToKilogram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Liszt\EvokanalToDekagram as LisztEvokanalToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Liszt\EvokanalToGram as LisztEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Liszt\EvokanalToKilogram as LisztEvokanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Porcukor\EvokanalToDekagram as PorcukorEvokanalToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Porcukor\EvokanalToGram as PorcukorEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Porcukor\EvokanalToKilogram as PorcukorEvokanalToKiloGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\So\CsipetToGram as SoCsipetToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\So\EvokanalToGram as SoEvokanalToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\So\KaveskanalToGram as SoKaveskanalToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\So\KiskanalToGram as SoKiskanalToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\So\TeaskanalToGram as SoTeaskanalToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tejfol\CentiliterToGram as TejfolCentiliterToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tejfol\DeciliterToGram as TejfolDeciliterToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tejfol\MilliliterToGram as TejfolMilliliterToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tomeg\DekagramToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tomeg\DekagramToKilogram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tomeg\GramToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tomeg\GramToKilogram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tomeg\KilogramToDekagram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tomeg\KilogramToGram;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\BogreToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\CentiliterToDeciliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\CentiliterToLiter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\CentiliterToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\CseppToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\CseszeToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\DeciliterToCentiliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\DeciliterToLiter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\DeciliterToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\LiterToCentiliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\LiterToDeciliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\LiterToMilliliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\MilliliterToCentiliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\MilliliterToCsepp;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\MilliliterToDeciliter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Urtartalom\MilliliterToLiter;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Vorosbab\KonzervToGram as VorosbabKonzervToGram;

class MertekegysegValtoCollection
{
    /** @var MertekegysegValto[] */
    private array $elements;

    public function __construct()
    {
        $this->elements = [
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
        ];
    }

    /**
     * @throws UnknownUnitOfMeasureException
     */
    public function get(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): MertekegysegValto
    {
        foreach ($this->elements as $element) {
            if ($element->canValt($hozzavalo, $hozzaadottHozzavalo)) {
                return $element;
            }
        }

        throw new UnknownUnitOfMeasureException(sprintf('Cannot convert %s to %s', $hozzavalo, $hozzaadottHozzavalo));
    }
}
