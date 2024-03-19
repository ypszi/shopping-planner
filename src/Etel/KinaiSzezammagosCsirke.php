<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KinaiSzezammagosCsirke extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Kínai szezámmagos csirke';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::NAPRAFORGO_OLAJ, 1, Mertekegyseg::EK),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::NAPRAFORGO_OLAJ, 3, Mertekegyseg::DL),
            // chili ízlés szerint
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::CHILI, 1, Mertekegyseg::MK),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::SUTOPOR, 1.5, Mertekegyseg::KK),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::KEMENYITO, 3, Mertekegyseg::EK),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::MEZ, 2, Mertekegyseg::TK),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::SZEZAMMAG, 3, Mertekegyseg::EK),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::FINOMLISZT, 6, Mertekegyseg::EK),
            new Hozzavalo(HozzavaloKategoria::HUS, Hozzavalo::CSIRKEMELL, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::HUTOS, Hozzavalo::TOJAS, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::HUTOS_UTAN, Hozzavalo::KETCHUP, 100, Mertekegyseg::G),
        ];
    }
}
