<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Porehagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class SerpenyosCsirkemell extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Serpenyős csirkemell';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Csirkemell(60, Mertekegyseg::DKG),
            new OlivaOlaj(4, Mertekegyseg::EK),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new Porehagyma(1, Mertekegyseg::DB),
            new Petrezselyem(1, Mertekegyseg::TK),
            new So(0.5, Mertekegyseg::TK),
            new Bors(0.5, Mertekegyseg::MK),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://femina.hu/recept/serpenyos-csirkemell/';
    }
}
