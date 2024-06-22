<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Citrombors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hal\Lazac;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Vaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Brokkoli;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class LazacBrokkolival extends Etel
{
    public static function name(): string
    {
        return 'Lazac brokkolival';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Lazac(40, Mertekegyseg::DKG),
            new Brokkoli(1, Mertekegyseg::DB),
            new So(2, Mertekegyseg::CSIPET),
            new Bors(1, Mertekegyseg::CSIPET),
            new Citrombors(1, Mertekegyseg::CSIPET),
            new OlivaOlaj(2, Mertekegyseg::EK),
            new Vaj(1, Mertekegyseg::TK),
            new Petrezselyem(1, Mertekegyseg::MK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/lazac-brokkolival';
    }
}
