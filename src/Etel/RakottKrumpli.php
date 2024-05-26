<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Felvagott\BaconKockazott;
use PeterPecosz\Kajatervezo\Hozzavalo\Felvagott\Kolbasz;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Vaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Krumpli;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class RakottKrumpli extends Etel
{
    public static function name(): string
    {
        return 'Rakott krumpli';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Krumpli(1, Mertekegyseg::KG),
            new Tojas(6, Mertekegyseg::DB),
            new So(1, Mertekegyseg::TK),
            new Kolbasz(10, Mertekegyseg::DKG),
            new Tejfol(5, Mertekegyseg::DL),
            new Vaj(2, Mertekegyseg::TK),
            new BaconKockazott(10, Mertekegyseg::DKG),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/rakott-krumpli.recept/';
    }
}
