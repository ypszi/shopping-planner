<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Ecet\BalzsamecetFeher;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\FeherbabKonzerv;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\TonhalKonzerv;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Citrom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Koktelparadicsom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Lilahagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TonhalasBabsalata extends Etel
{
    public static function name(): string
    {
        return 'Tonhalas babsaláta';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Citrom(1, Mertekegyseg::DB),
            new BalzsamecetFeher(1, Mertekegyseg::EK),
            new So(3, Mertekegyseg::CSIPET),
            new Bors(1, Mertekegyseg::CSIPET),
            new Cukor(1, Mertekegyseg::CSIPET),
            new NapraforgoOlaj(2, Mertekegyseg::EK),
            new Petrezselyem(1, Mertekegyseg::TK),
            new FeherbabKonzerv(250, Mertekegyseg::G),
            new TonhalKonzerv(185, Mertekegyseg::G),
            new Lilahagyma(1, Mertekegyseg::DB),
            new Koktelparadicsom(20, Mertekegyseg::DKG),
        ];
    }

    public static function defaultAdag(): int
    {
        return 2;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/tonhalas-babsalata-glaser-konyhajabol';
    }
}
