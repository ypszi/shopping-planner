<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
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
            new Hozzavalo(Hozzavalo::PIROS_PAPRIKA, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::FUSZERKEVEREK, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::NAPRAFORGO_OLAJ, 4, Mertekegyseg::DL),
            new Hozzavalo(Hozzavalo::LISZT, 25, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::SUTOPOR, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::KEFIR, 3, Mertekegyseg::DL),
        ];
    }

    #[\Override] protected static function getDefaultAdag(): int
    {
        return 4;
    }
}
