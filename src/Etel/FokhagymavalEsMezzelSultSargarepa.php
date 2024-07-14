<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Mez;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Sargarepa;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class FokhagymavalEsMezzelSultSargarepa extends Etel
{
    public static function name(): string
    {
        return 'Fokhagymával és mézzel sült sárgarépa';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Sargarepa(5, Mertekegyseg::DB),
            new Fokhagyma(6, Mertekegyseg::GEREZD),
            new Mez(3, Mertekegyseg::EK),
            new OlivaOlaj(3, Mertekegyseg::EK),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::CSIPET),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://sobors.hu/receptek/fokhagymaval-mezzel-sult-sargarepa-recept/';
    }
}
