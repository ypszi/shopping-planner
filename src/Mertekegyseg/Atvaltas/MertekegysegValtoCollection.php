<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Csirkemell\DarabToDekagram as CsirkemellDarabToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Csirkemell\DarabToKilogram as CsirkemellDarabToKilogram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Csirkemell\DekagramToDarab as CsirkemellDekagramToDarab;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Csirkemell\KilogramToDarab as CsirkemellKilogramToDarab;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor\EvokanalToDekagram as CukorEvokanalToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor\EvokanalToGram as CukorEvokanalToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor\EvokanalToKilogram as CukorEvokanalToKiloGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor\MokkaskanalToDekagram as CukorMokkaskanalToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor\MokkaskanalToGram as CukorMokkaskanalToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor\MokkaskanalToKilogram as CukorMokkaskanalToKiloGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor\TeaskanalToDekagram as CukorTeaskanalToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor\TeaskanalToGram as CukorTeaskanalToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor\TeaskanalToKilogram as CukorTeaskanalToKilogram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\FinomLiszt\BogreToDekagram as FinomLisztBogreToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\FinomLiszt\BogreToGram as FinomLisztBogreToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\FinomLiszt\BogreToKilogram as FinomLisztBogreToKilogram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\FinomLiszt\EvokanalToDekagram as FinomLisztEvokanalToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\FinomLiszt\EvokanalToGram as FinomLisztEvokanalToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\FinomLiszt\EvokanalToKilogram as FinomLisztEvokanalToKiloGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\EvoKanalToDeciliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\EvoKanalToKavesKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\EvoKanalToKisKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\EvoKanalToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\EvoKanalToMokkasKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\EvoKanalToTeasKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\KavesKanalToEvoKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\KavesKanalToKisKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\KavesKanalToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\KavesKanalToMokkasKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\KavesKanalToTeasKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\KisKanalToEvoKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\KisKanalToKavesKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\KisKanalToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\KisKanalToMokkasKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\KisKanalToTeasKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\MilliliterToEvoKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\MilliliterToKavesKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\MilliliterToKisKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\MilliliterToMokkasKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\MilliliterToTeasKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToEvoKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToKavesKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToKisKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\MokkasKanalToTeasKanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\TeasKanalToDeciliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\TeasKanalToEvokanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\TeasKanalToKaveskanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\TeasKanalToKiskanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\TeasKanalToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal\TeasKanalToMokkaskanal;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kukorica\KonzervToGram as KukoricaKonzervToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Liszt\BogreToDekagram as LisztBogreToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Liszt\BogreToGram as LisztBogreToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Liszt\BogreToKilogram as LisztBogreToKilogram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Liszt\EvokanalToDekagram as LisztEvokanalToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Liszt\EvokanalToGram as LisztEvokanalToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Liszt\EvokanalToKilogram as LisztEvokanalToKiloGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Porcukor\EvokanalToDekagram as PorcukorEvokanalToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Porcukor\EvokanalToGram as PorcukorEvokanalToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Porcukor\EvokanalToKilogram as PorcukorEvokanalToKiloGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\So\CsipetToGram as SoCsipetToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\So\EvokanalToGram as SoEvokanalToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\So\KaveskanalToGram as SoKaveskanalToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\So\KiskanalToGram as SoKiskanalToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\So\TeaskanalToGram as SoTeaskanalToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tejfol\CentiliterToGram as TejfolCentiliterToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tejfol\DeciliterToGram as TejfolDeciliterToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tejfol\MilliliterToGram as TejfolMilliliterToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tomeg\DekagramToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tomeg\DekagramToKilogram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tomeg\GramToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tomeg\GramToKilogram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tomeg\KilogramToDekagram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tomeg\KilogramToGram;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\BogreToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\CentiliterToDeciliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\CentiliterToLiter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\CentiliterToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\CseppToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\CseszeToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\DeciliterToCentiliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\DeciliterToLiter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\DeciliterToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\LiterToCentiliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\LiterToDeciliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\LiterToMilliliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\MilliliterToCentiliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\MilliliterToCsepp;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\MilliliterToDeciliter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom\MilliliterToLiter;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Vorosbab\KonzervToGram as VorosbabKonzervToGram;

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
            new EvoKanalToMilliliter(),
            new EvoKanalToMokkasKanal(),
            new EvoKanalToTeasKanal(),
            new KavesKanalToEvoKanal(),
            new KavesKanalToKisKanal(),
            new KavesKanalToMilliliter(),
            new KavesKanalToMokkasKanal(),
            new KavesKanalToTeasKanal(),
            new KisKanalToEvoKanal(),
            new KisKanalToKavesKanal(),
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
            new MokkasKanalToMilliliter(),
            new MokkasKanalToTeasKanal(),
            new TeasKanalToDeciliter(),
            new TeasKanalToEvokanal(),
            new TeasKanalToKaveskanal(),
            new TeasKanalToKiskanal(),
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
    public function get(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): MertekegysegValto
    {
        foreach ($this->elements as $element) {
            if ($element->canValt($hozzavalo, $hozzaadottHozzavalo)) {
                return $element;
            }
        }

        throw new UnknownUnitOfMeasureException(sprintf('Cannot convert %s to %s', $hozzavalo, $hozzaadottHozzavalo));
    }
}
