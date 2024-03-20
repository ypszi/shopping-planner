<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class CitromosSpargasCsirkesPenne extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Citromos Spárgás Csirkés Penne';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(Hozzavalo::VOROSHAGYMA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::CITROM, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::FOKHAGYMA, 6, Mertekegyseg::GEREZD),
            new Hozzavalo(Hozzavalo::KAKUKKFU, 1, Mertekegyseg::KK),
            new Hozzavalo(Hozzavalo::FEHERBOR, 1, Mertekegyseg::DL),
            new Hozzavalo(Hozzavalo::PENNE_TESZTA, 50, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::PARMEZAN, 10, Mertekegyseg::G),
            new Hozzavalo(Hozzavalo::TEJSZIN, 4, Mertekegyseg::DL),
        ];
    }

    #[\Override] protected static function getDefaultAdag(): int
    {
        return 4;
    }
}
