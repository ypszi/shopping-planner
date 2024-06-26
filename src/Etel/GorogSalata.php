<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bazsalikom;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Sajt\FetaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\OlivabogyoKonzerv;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Citrom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Kigyouborka;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Lilahagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Paradicsom;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class GorogSalata extends Etel
{
    public static function name(): string
    {
        return 'Görög saláta';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Paradicsom(4, Mertekegyseg::DB),
            new Kigyouborka(1, Mertekegyseg::DB),
            new Lilahagyma(4, Mertekegyseg::DB),
            new FetaSajt(125, Mertekegyseg::G),
            new OlivaOlaj(4, Mertekegyseg::EK),
            new Citrom(1, Mertekegyseg::DB),
            new Bazsalikom(1, Mertekegyseg::TK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 6;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/eredeti-gorog-salata';
    }

    public function comments(): array
    {
        return ['opcionális: ' . new OlivabogyoKonzerv(20, Mertekegyseg::DKG), ...parent::comments()];
    }
}
