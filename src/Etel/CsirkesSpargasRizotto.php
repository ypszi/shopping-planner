<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Bor\Feherbor;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\HuslevesKocka;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\RizottoRizs;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\ParmezanSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Sparga;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class CsirkesSpargasRizotto extends Etel
{
    public static function name(): string
    {
        return 'Csirkés spárgás rizottó';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Csirkemell(35, Mertekegyseg::DKG),
            new RizottoRizs(25, Mertekegyseg::DKG),
            new Sparga(8, Mertekegyseg::DB),
            new Feherbor(2.5, Mertekegyseg::DL),
            new ParmezanSajt(5, Mertekegyseg::DKG),
            new Voroshagyma(1, Mertekegyseg::DB),
            new HuslevesKocka(2, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new OlivaOlaj(3, Mertekegyseg::EK),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::MK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function receptUrl(): string
    {
        return 'https://femina.hu/recept/csirkes-spargas-rizotto-receptje/';
    }
}
