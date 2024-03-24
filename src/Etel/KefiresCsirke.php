<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Fuszerkeverek;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
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
            new Hozzavalo(Hozzavalo::LISZT, 25, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::SUTOPOR, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::KEFIR, 3, Mertekegyseg::DL),
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
