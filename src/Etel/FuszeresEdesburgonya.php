<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Rozmaring;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Edesburgonya;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Lilahagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class FuszeresEdesburgonya extends Etel
{
    public static function name(): string
    {
        return 'Fűszeres édesburgonya';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Edesburgonya(1, Mertekegyseg::KG),
            new OlivaOlaj(2, Mertekegyseg::EK),
            new Lilahagyma(1, Mertekegyseg::DB),
            // 1 ág rozmaring
            new Rozmaring(1, Mertekegyseg::MK),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::CSIPET),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function receptUrl(): string
    {
        return 'https://femina.hu/recept/fuszeres-edesburgonya-receptje/';
    }
}
