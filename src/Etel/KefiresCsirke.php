<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Fuszerkeverek;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Liszt;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Sutopor;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Kefir;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KefiresCsirke extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Kefíres csirke';
    }

    #[\Override] protected static function listHozzavalok(): array
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

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'http://chiliesvanilia.blogspot.com/2016/08/szuperropogos-rantott-csirke-husz-perc.html';
    }
}
