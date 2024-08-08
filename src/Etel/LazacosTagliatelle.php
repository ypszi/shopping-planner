<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Bor\Feherbor;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hal\FustoltLazac;
use PeterPecosz\Kajatervezo\Hozzavalo\Hal\Lazac;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\ParadicsomPure;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\TagliatelleTeszta;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Fozotejszin;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class LazacosTagliatelle extends Etel
{
    public static function name(): string
    {
        return 'Lazacos tagliatelle';
    }

    protected function listHozzavalok(): array
    {
        return [
            new OlivaOlaj(0.5, Mertekegyseg::DL),
            new Lazac(250, Mertekegyseg::G),
            new Fokhagyma(4, Mertekegyseg::GEREZD),
            new Feherbor(1, Mertekegyseg::DL),
            new ParadicsomPure(2, Mertekegyseg::DL),
            new Fozotejszin(1.5, Mertekegyseg::DL),
            new TagliatelleTeszta(0.5, Mertekegyseg::KG),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::TK),
            new Petrezselyem(5, Mertekegyseg::G),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/lazacos-tagliatelle';
    }

    public function comments(): array
    {
        return [
            'A recept ír még ' . (new FustoltLazac(100, Mertekegyseg::G)) . '-ot is, de azt szándékosan nem tartalmazza',
            '1 dl víz',
            '0.5 csokor petrezselyem',
            ...parent::comments(),
        ];
    }
}
