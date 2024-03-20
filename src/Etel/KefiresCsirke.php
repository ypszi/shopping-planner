<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KefiresCsirke extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Kefíres csirke';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::PIROS_PAPRIKA, 1, Mertekegyseg::TK),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::FUSZERKEVEREK, 1, Mertekegyseg::EK),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::NAPRAFORGO_OLAJ, 4, Mertekegyseg::DL),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::LISZT, 25, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::SUTOPOR, 1, Mertekegyseg::EK),
            new Hozzavalo(HozzavaloKategoria::HUS, Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::HUTOS, Hozzavalo::KEFIR, 3, Mertekegyseg::DL),
        ];
    }
}
