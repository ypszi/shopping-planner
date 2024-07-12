<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Sajt\TrappistaSajtFustolt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Tejszin;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TejfolosFustoltSajtosCsirkemell extends Etel
{
    public static function name(): string
    {
        return 'Tejfölös-Füstölt Sajtos Csirkemell';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Csirkemell(80, Mertekegyseg::DKG),
            new TrappistaSajtFustolt(25, Mertekegyseg::DKG),
            new Fokhagyma(4, Mertekegyseg::GEREZD),
            new OlivaOlaj(1, Mertekegyseg::EK),
            new So(1, Mertekegyseg::TK),
            new Bors(2, Mertekegyseg::CSIPET),
            new Tejszin(2, Mertekegyseg::DL),
            new Tejfol(30, Mertekegyseg::DKG),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.mindmegette.hu/tejfolos-fustolt-sajtos-csirkemell.recept/';
    }
}
