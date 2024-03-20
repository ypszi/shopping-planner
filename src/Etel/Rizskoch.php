<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Rizskoch extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Rizskoch';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::CITROM, 0.5, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::RIZS, 250, Mertekegyseg::G),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::VANILIAS_CUKOR, 250, Mertekegyseg::G),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::CUKOR, 130, Mertekegyseg::G),
            // porcukor ízlés szerint
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::PORCUKOR, 100, Mertekegyseg::G),
            // baracklekvár ízlés szerint
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::BARACK_LEKVAR, 150, Mertekegyseg::G),
            new Hozzavalo(HozzavaloKategoria::HUTOS, Hozzavalo::TOJAS, 5, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::HUTOS_UTAN, Hozzavalo::TEJ, 8, Mertekegyseg::DL),
        ];
    }
}
