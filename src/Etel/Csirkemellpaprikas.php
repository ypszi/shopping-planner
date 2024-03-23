<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Paprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Paradicsom;
use PeterPecosz\Kajatervezo\Hozzavalo\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Csirkemellpaprikas extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Csirkemellpaprikás';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Voroshagyma(1, Mertekegyseg::DB),
            new Fokhagyma(1, Mertekegyseg::GEREZD),
            new Paradicsom(1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::PIROS_PAPRIKA, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::FEHERBOR, 1, Mertekegyseg::DL),
            new Paprika(2, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 1, Mertekegyseg::KG),
            new Hozzavalo(Hozzavalo::TEJFOL, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::TEJSZIN, 1, Mertekegyseg::DL),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/csirkemellpaprikas.recept/';
    }
}
