<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BaconbeGongyoltMozzarellasCsirkemell extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Baconbe göngyölt mozzarellás csirkemell';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::MOZZARELLA_SAJT, 20, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::BACON_SZELETELT, 20, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::SO, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::BAZSALIKOM, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::OLIVA_OLAJ, 3, Mertekegyseg::EK),
        ];
    }

    #[\Override] public static function getDefaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function getReceptUrl(): string
    {
        return 'https://www.mindmegette.hu/baconbe-gongyolt-mozzarellas-csirkemell.recept/';
    }
}
