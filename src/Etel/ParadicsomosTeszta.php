<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Bazsalikom;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Majoranna;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\So;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\FusilliTeszta;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\ParadicsomKonzerv;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\ParmezanSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan\Fozotejszin;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class ParadicsomosTeszta extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Paradicsomos tészta';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new OlivaOlaj(2, Mertekegyseg::EK),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new Majoranna(1, Mertekegyseg::MK),
            new Bazsalikom(1, Mertekegyseg::MK),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::CSIPET),
            new Fozotejszin(2, Mertekegyseg::DL),
            new ParadicsomKonzerv(45, Mertekegyseg::DKG),
            new ParmezanSajt(10, Mertekegyseg::DKG),
            new FusilliTeszta(40, Mertekegyseg::DKG),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/nagyon-kremes-paradicsomos-teszta-husmentesen.recept/';
    }
}
