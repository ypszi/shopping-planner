<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Fuszerkomeny;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Mustar;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class FuszeresCsirkecsikok extends Etel
{
    public static function name(): string
    {
        return 'Fűszeres csirkecsíkok';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Csirkemell(2, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new Mustar(1, Mertekegyseg::TK),
            new Fuszerkomeny(1, Mertekegyseg::KK),
            new So(1, Mertekegyseg::TK),
            new Bors(2, Mertekegyseg::CSIPET),
            new OlivaOlaj(2, Mertekegyseg::EK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://femina.hu/recept/fokhagymas-fuszeres-csirkecsikok/';
    }
}
