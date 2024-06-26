<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Porehagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class SerpenyosCsirkemell extends Etel
{
    public static function name(): string
    {
        return 'Serpenyős csirkemell';
    }

    protected function listHozzavalok(): array
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

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://femina.hu/recept/serpenyos-csirkemell/';
    }
}
