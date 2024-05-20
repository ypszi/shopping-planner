<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\FuszerPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\GoudaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TejfolosSajtosCsirkemell extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Tejfölös-sajtos csirkemell';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Csirkemell(2, Mertekegyseg::DB),
            new Tejfol(250, Mertekegyseg::G),
            new GoudaSajt(30, Mertekegyseg::DKG),
            new FuszerPaprika(5, Mertekegyseg::TK),
            new So(0.5, Mertekegyseg::TK),
            new Bors(0.5, Mertekegyseg::MK),
            new Petrezselyem(1, Mertekegyseg::TK),
            new OlivaOlaj(5, Mertekegyseg::EK),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/tejfolos-sajtos-csirkemell');
    }
}
