<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class CitromosJoghurtosCsirkemell extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Citromos joghurtos csirkemell';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::CITROM, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::JEGSALATA, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::KIGYOUBORKA, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::KOKTELPARADICSOM, 40, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::LILAHAGYMA, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::OLIVA_OLAJ, 3, Mertekegyseg::EK),
            // oregano ízlés szerint
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::OREGANO, 1, Mertekegyseg::TK),
            new Hozzavalo(HozzavaloKategoria::HUS, Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::HUTOS, Hozzavalo::NATUR_JOGHURT, 37.5, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::HUTOS, Hozzavalo::FETA_SAJT, 20, Mertekegyseg::DKG),
        ];
    }
}
