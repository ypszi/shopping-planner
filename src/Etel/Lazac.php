<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Kakukkfu;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Rozmaring;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hal\Lazac as NyersLazac;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Vaj;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Lazac extends Etel
{
    public static function name(): string
    {
        return 'Lazac';
    }

    protected function listHozzavalok(): array
    {
        return [
            new NyersLazac(36, Mertekegyseg::DKG),
            new So(2, Mertekegyseg::CSIPET),
            new Bors(1, Mertekegyseg::CSIPET),
            new Rozmaring(2, Mertekegyseg::CSIPET),
            new Kakukkfu(2, Mertekegyseg::CSIPET),
            new NapraforgoOlaj(2, Mertekegyseg::EK),
            new Vaj(1, Mertekegyseg::EK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 2;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/lazac-egyszeruen';
    }
}
