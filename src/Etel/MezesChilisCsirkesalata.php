<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Ecet\Rizsecet;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Chili;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\MogyoroOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\SzezamOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Mez;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\KaliforniaiPaprikaPiros;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\KinaiKel;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Lilahagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Sargarepa;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class MezesChilisCsirkesalata extends Etel
{
    public static function name(): string
    {
        return 'Mézes-chilis csirkesaláta';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Csirkemell(25, Mertekegyseg::DKG),
            new KinaiKel(25, Mertekegyseg::DKG),
            new KaliforniaiPaprikaPiros(0.5, Mertekegyseg::DB),
            new Sargarepa(1, Mertekegyseg::DB),
            new Lilahagyma(0.3, Mertekegyseg::DB),
            new Chili(0.5, Mertekegyseg::TK),
            // só ízlés szerint
            new So(2, Mertekegyseg::CSIPET),
            // bors ízlés szerint
            new Bors(1, Mertekegyseg::CSIPET),
            new Mez(1, Mertekegyseg::EK),
            new MogyoroOlaj(1, Mertekegyseg::EK),
            // Az öntethez
            new SzezamOlaj(6, Mertekegyseg::EK),
            new Rizsecet(2, Mertekegyseg::EK),
            new So(2, Mertekegyseg::CSIPET),
            new Bors(1, Mertekegyseg::CSIPET),
            new Fokhagyma(1, Mertekegyseg::GEREZD),
        ];
    }

    public static function defaultAdag(): int
    {
        return 2;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/mezes-chilis-csirkesalata';
    }

    public function comments(): array
    {
        return [
            'Az öntethez: ',
            new SzezamOlaj(6, Mertekegyseg::EK),
            new Rizsecet(2, Mertekegyseg::EK),
            new So(2, Mertekegyseg::CSIPET),
            new Bors(1, Mertekegyseg::CSIPET),
            new Fokhagyma(1, Mertekegyseg::GEREZD),
            ...parent::comments(),
        ];
    }
}
