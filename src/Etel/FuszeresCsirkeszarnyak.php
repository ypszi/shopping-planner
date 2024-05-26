<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Chili;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Kakukkfu;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkeszarny;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Citrom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class FuszeresCsirkeszarnyak extends Etel
{
    public static function name(): string
    {
        return 'Fűszeres csirkeszárnyak';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Csirkeszarny(1, Mertekegyseg::KG),
            new NapraforgoOlaj(0.5, Mertekegyseg::DL),
            new Fokhagyma(3, Mertekegyseg::GEREZD),
            new PirosPaprika(1, Mertekegyseg::TK),
            new Citrom(0.5, Mertekegyseg::DB),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::MK),
            new Chili(1, Mertekegyseg::MK),
            new Kakukkfu(1, Mertekegyseg::MK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function receptUrl(): string
    {
        return 'https://femina.hu/recept/fuszeres-csirkeszarnyak/';
    }
}
