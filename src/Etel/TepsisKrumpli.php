<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Rozmaring;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Burgonya;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TepsisKrumpli extends Etel
{
    public static function name(): string
    {
        return 'Tepsis Krumpli';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Burgonya(1, Mertekegyseg::KG),
            new PirosPaprika(1, Mertekegyseg::TK),
            new So(1, Mertekegyseg::KVK),
            new Bors(1, Mertekegyseg::KVK),
            new Rozmaring(1, Mertekegyseg::MK),
            new NapraforgoOlaj(1, Mertekegyseg::DL),
        ];
    }

    public static function defaultAdag(): int
    {
        return 3;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/fuszeres-sult-krumpli-szilvus-konyhajabol';
    }
}
