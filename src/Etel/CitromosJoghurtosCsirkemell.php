<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
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
            new Hozzavalo(Hozzavalo::CITROM, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::JEGSALATA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::KIGYOUBORKA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::KOKTELPARADICSOM, 40, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::LILAHAGYMA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::OLIVA_OLAJ, 3, Mertekegyseg::EK),
            // oregano ízlés szerint
            new Hozzavalo(Hozzavalo::OREGANO, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::NATUR_JOGHURT, 37.5, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::FETA_SAJT, 20, Mertekegyseg::DKG),
        ];
    }

    #[\Override] public static function getDefaultAdag(): int
    {
        return 4;
    }
}
