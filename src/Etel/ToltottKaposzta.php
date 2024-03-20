<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class ToltottKaposzta extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Töltött káposzta';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::SAVANYU_KAPOSZTA, 1, Mertekegyseg::KG),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::KAPOSZTA, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::VOROSHAGYMA, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::FOKHAGYMA, 2, Mertekegyseg::GEREZD),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::FUSZER_PAPRIKA, 3, Mertekegyseg::TK),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::FUSZERKOMENY, 1, Mertekegyseg::TK),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::BABERLEVEL, 5, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::RIZS, 20, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::FINOMLISZT, 1, Mertekegyseg::EK),
            new Hozzavalo(HozzavaloKategoria::HUS, Hozzavalo::DARALT_HUS, 50, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::HUS, Hozzavalo::KOLOZSVARI_SZALONNA, 20, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::HUS, Hozzavalo::KOLBASZ, 20, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::HUS, Hozzavalo::SERTES_ZSIR, 1, Mertekegyseg::EK),
        ];
    }
}
