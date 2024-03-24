<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Kakukkfu;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Feherbor;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\PenneTeszta;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Citrom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class CitromosSpargasCsirkesPenne extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Citromos spárgás csirkés penne';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Voroshagyma(1, Mertekegyseg::DB),
            new Citrom(1, Mertekegyseg::DB),
            new Fokhagyma(6, Mertekegyseg::GEREZD),
            new Kakukkfu(1, Mertekegyseg::KK),
            new Feherbor(1, Mertekegyseg::DL),
            new PenneTeszta(50, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::PARMEZAN, 10, Mertekegyseg::G),
            new Hozzavalo(Hozzavalo::TEJSZIN, 4, Mertekegyseg::DL),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/citromos-spargas-csirkes-penne.recept/';
    }
}
