<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Csirkemellpaprikas extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Csirkemellpaprikás';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(Hozzavalo::VOROSHAGYMA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::FOKHAGYMA, 1, Mertekegyseg::GEREZD),
            new Hozzavalo(Hozzavalo::PARADICSOM, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::PIROS_PAPRIKA, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::FEHERBOR, 1, Mertekegyseg::DL),
            new Hozzavalo(Hozzavalo::PAPRIKA, 2, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 1, Mertekegyseg::KG),
            new Hozzavalo(Hozzavalo::TEJFOL, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::TEJSZIN, 1, Mertekegyseg::DL),
        ];
    }

    #[\Override] public static function getDefaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function getReceptUrl(): string
    {
        return 'https://www.mindmegette.hu/csirkemellpaprikas.recept/';
    }
}
