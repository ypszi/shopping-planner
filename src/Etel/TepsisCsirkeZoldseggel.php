<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Brokkoli;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Cukkini;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\KaliforniaiPaprikaPiros;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Krumpli;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Lilahagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Sargarepa;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TepsisCsirkeZoldseggel extends Etel
{
    public static function name(): string
    {
        return 'Tepsis Csirke Zöldséggel';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Csirkemell(50, Mertekegyseg::DKG),
            new Lilahagyma(2, Mertekegyseg::DB),
            new Fokhagyma(5, Mertekegyseg::GEREZD),
            new Sargarepa(2, Mertekegyseg::DB),
            new Brokkoli(1, Mertekegyseg::DB),
            new KaliforniaiPaprikaPiros(1, Mertekegyseg::DB),
            new Krumpli(5, Mertekegyseg::DB),
            new Cukkini(5, Mertekegyseg::DB),
            new So(1, Mertekegyseg::TK),
            new Bors(2, Mertekegyseg::CSIPET),
            new PirosPaprika(1, Mertekegyseg::TK),
            new OlivaOlaj(2, Mertekegyseg::TK),
            // Az öntethez
            new Tejfol(200, Mertekegyseg::G),
            new Fokhagyma(1, Mertekegyseg::GEREZD),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.mindmegette.hu/tepsis-csirke-zoldseggel.recept/';
    }

    public function comments(): array
    {
        return [
            'Az öntethez: ',
            new Tejfol(200, Mertekegyseg::G),
            new Fokhagyma(1, Mertekegyseg::GEREZD),
            ...parent::comments(),
        ];
    }
}
