<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Csemegehagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Kigyouborka;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Retek;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class RetkesUborkaSalata extends Etel
{
    public static function name(): string
    {
        return 'Retkes uborka saláta';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Kigyouborka(1, Mertekegyseg::DB),
            new Retek(20, Mertekegyseg::DB),
            new Csemegehagyma(20, Mertekegyseg::DB),
            new Tejfol(250, Mertekegyseg::ML),
            new So(1, Mertekegyseg::TK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://natashaskitchen.com/cucumber-radish-salad-recipe/';
    }
}
