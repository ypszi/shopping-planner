<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BundasCsirke extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Bundás csirke';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::FOKHAGYMA, 3, Mertekegyseg::GEREZD),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::NAPRAFORGO_OLAJ, 2, Mertekegyseg::DL),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::GYOMBER_POR, 1.5, Mertekegyseg::TK),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::SZERECSENDIO, 1, Mertekegyseg::TK),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::FUSZER_PAPRIKA, 1, Mertekegyseg::TK),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::ZOLDFUSZER, 1, Mertekegyseg::TK),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::CAYENNE_BORS, 0.5, Mertekegyseg::TK),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::OLIVA_OLAJ, 2, Mertekegyseg::EK),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::FINOMLISZT, 1, Mertekegyseg::BOGRE),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::MEZ, 50, Mertekegyseg::ML),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::SZOJASZOSZ, 50, Mertekegyseg::ML),
            new Hozzavalo(HozzavaloKategoria::HUS, Hozzavalo::CSIRKEMELL, 4, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::HUTOS_UTAN, Hozzavalo::TOJAS, 3, Mertekegyseg::DB),
        ];
    }
}
