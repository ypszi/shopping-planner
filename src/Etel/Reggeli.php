<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Felvagott\Felvagott;
use PeterPecosz\Kajatervezo\Hozzavalo\Pekaru\Kenyer;
use PeterPecosz\Kajatervezo\Hozzavalo\Sajt\GoudaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Tej;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Kigyouborka;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Koktelparadicsom;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Reggeli extends Etel
{
    public static function name(): string
    {
        return 'Reggeli';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Kenyer(0.5, Mertekegyseg::KG),
            new Felvagott(40, Mertekegyseg::DKG),
            new GoudaSajt(20, Mertekegyseg::DKG),
            new Tej(1, Mertekegyseg::L),
            new Koktelparadicsom(20, Mertekegyseg::DKG),
            new Kigyouborka(1, Mertekegyseg::DB),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return '';
    }
}
