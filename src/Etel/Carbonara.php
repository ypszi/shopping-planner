<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Szerecsendio;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\KolozsvariSzalonna;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Sajt\ParmezanSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\SpagettiTeszta;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Carbonara extends Etel
{
    public static function name(): string
    {
        return 'Carbonara';
    }

    protected function listHozzavalok(): array
    {
        return [
            new KolozsvariSzalonna(150, Mertekegyseg::G),
            new OlivaOlaj(2, Mertekegyseg::EK),
            new SpagettiTeszta(250, Mertekegyseg::G),
            new Tojas(4, Mertekegyseg::DB),
            new So(1, Mertekegyseg::MK),
            new Bors(1, Mertekegyseg::CSIPET),
            new ParmezanSajt(80, Mertekegyseg::G),
            new Szerecsendio(1, Mertekegyseg::CSIPET),
        ];
    }

    public static function defaultAdag(): int
    {
        return 2;
    }

    public function rawReceptUrl(): string
    {
        return 'https://streetkitchen.hu/tesztapolc/az-eredeti-carbonara/';
    }

    public function comments(): array
    {
        return [
            '150-200 ml tésztafőzővíz',
            ...parent::comments(),
        ];
    }
}
