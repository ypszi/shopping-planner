<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bazsalikom;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Oregano;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Sajt\TrappistaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Paradicsom;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class OlaszosCsirke extends Etel
{
    public static function name(): string
    {
        return 'Olaszos csirke';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Csirkemell(2, Mertekegyseg::DB),
            new Paradicsom(0.5, Mertekegyseg::KG),
            new TrappistaSajt(30, Mertekegyseg::DKG),
            new Oregano(4.5, Mertekegyseg::G),
            new Bazsalikom(2.5, Mertekegyseg::G),
            new So(2, Mertekegyseg::CSIPET),
            new Bors(1, Mertekegyseg::CSIPET),
            new NapraforgoOlaj(1, Mertekegyseg::EK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/olaszos-csirke-tepsiben';
    }
}
