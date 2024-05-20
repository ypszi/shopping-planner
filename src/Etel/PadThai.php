<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Azsiai\HalSzosz;
use PeterPecosz\Kajatervezo\Hozzavalo\Azsiai\RizsTeszta;
use PeterPecosz\Kajatervezo\Hozzavalo\Azsiai\TamarindSzosz;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Chili;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Mogyoro;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\SzezamOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Gyomber;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Lime;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\PakChoi;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class PadThai extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Pad thai';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Voroshagyma(1, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new Gyomber(1, Mertekegyseg::DB),
            new Chili(1, Mertekegyseg::MK),
            new Csirkemell(200, Mertekegyseg::G),
            new PakChoi(0.5, Mertekegyseg::DB),
            new RizsTeszta(150, Mertekegyseg::G),
            new SzezamOlaj(2, Mertekegyseg::EK),
            new NapraforgoOlaj(5, Mertekegyseg::EK),
            new Tojas(2, Mertekegyseg::DB),
            new Mogyoro(100, Mertekegyseg::G),
            new Lime(0.5, Mertekegyseg::DB),
            new TamarindSzosz(2, Mertekegyseg::TK),
            new HalSzosz(0.5, Mertekegyseg::TK),
            new SzezamOlaj(1, Mertekegyseg::EK),
            new Cukor(1, Mertekegyseg::TK),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 2;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://streetkitchen.hu/tesztapolc/az-igazi-pad-thai/';
    }
}
