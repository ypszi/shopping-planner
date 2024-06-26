<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Fuszerkeverek;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Liszt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Sutopor;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Kefir;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KefiresCsirke extends Etel
{
    public static function name(): string
    {
        return 'Kefíres csirke';
    }

    protected function listHozzavalok(): array
    {
        return [
            new PirosPaprika(1, Mertekegyseg::TK),
            new Fuszerkeverek(1, Mertekegyseg::EK),
            new NapraforgoOlaj(4, Mertekegyseg::DL),
            new Liszt(25, Mertekegyseg::DKG),
            new Sutopor(1, Mertekegyseg::EK),
            new Csirkemell(50, Mertekegyseg::DKG),
            new Kefir(3, Mertekegyseg::DL),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'http://chiliesvanilia.blogspot.com/2016/08/szuperropogos-rantott-csirke-husz-perc.html';
    }
}
