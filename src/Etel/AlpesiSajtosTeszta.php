<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Sajt\GoudaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\MakaroniTeszta;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Tej;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Tejszin;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Burgonya;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class AlpesiSajtosTeszta extends Etel
{
    public static function name(): string
    {
        return 'Alpesi Sajtos Tészta (Älplermagronen)';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Burgonya(40, Mertekegyseg::DKG),
            new So(1, Mertekegyseg::TK),
            new MakaroniTeszta(25, Mertekegyseg::DKG),
            new GoudaSajt(20, Mertekegyseg::DKG),
            new Tej(1.5, Mertekegyseg::DL),
            new Tejszin(1, Mertekegyseg::DL),
            new Bors(1, Mertekegyseg::CSIPET),
            new Voroshagyma(2, Mertekegyseg::DB),
            new OlivaOlaj(2, Mertekegyseg::EK),
            new Petrezselyem(1, Mertekegyseg::EK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.mindmegette.hu/alpesi-sajtos-teszta-alplermagronen.recept/';
    }

    public function comments(): array
    {
        return [
            'Vaj kell a tepsi kikenéséhez',
            'opcionális: ' . new Petrezselyem(1, Mertekegyseg::EK),
            ...parent::comments(),
        ];
    }
}
