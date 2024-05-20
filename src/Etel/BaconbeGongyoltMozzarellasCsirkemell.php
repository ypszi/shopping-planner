<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bazsalikom;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\BaconSzeletelt;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\MozzarellaSajt;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BaconbeGongyoltMozzarellasCsirkemell extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Baconbe göngyölt mozzarellás csirkemell';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Csirkemell(50, Mertekegyseg::DKG),
            new MozzarellaSajt(20, Mertekegyseg::DKG),
            new BaconSzeletelt(20, Mertekegyseg::DKG),
            new So(1, Mertekegyseg::TK),
            new Bazsalikom(1, Mertekegyseg::TK),
            new OlivaOlaj(3, Mertekegyseg::EK),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/baconbe-gongyolt-mozzarellas-csirkemell.recept/';
    }
}
