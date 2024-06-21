<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Ecet\Almaborecet;
use PeterPecosz\Kajatervezo\Hozzavalo\Ecet\Feherborecet;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\GorogJoghurt;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Kigyouborka;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Tzatziki extends Etel
{
    public static function name(): string
    {
        return 'Tzatziki';
    }

    protected function listHozzavalok(): array
    {
        return [
            new GorogJoghurt(300, Mertekegyseg::G),
            new Kigyouborka(1, Mertekegyseg::DB),
            new Fokhagyma(0.3, Mertekegyseg::GEREZD),
            new Feherborecet(3, Mertekegyseg::TK),
            new OlivaOlaj(2, Mertekegyseg::TK),
            new So(1, Mertekegyseg::CSIPET),
            new Bors(1, Mertekegyseg::CSIPET),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function receptUrl(): string
    {
        return 'https://akispetretzikis.com/recipe/1485/tzatziki';
    }

    public function comments(): array
    {
        return [new Feherborecet(3, Mertekegyseg::TK) . ' vagy ' . new Almaborecet(3, Mertekegyseg::TK), ...parent::comments()];
    }
}
