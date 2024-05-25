<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Bor\Feherbor;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Kakukkfu;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\PenneTeszta;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Tejszin;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\ParmezanSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Citrom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class CitromosSpargasCsirkesPenne extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Citromos spárgás csirkés penne';
    }

    #[Override] protected function listHozzavalok(): array
    {
        return [
            new Voroshagyma(1, Mertekegyseg::DB),
            new Citrom(1, Mertekegyseg::DB),
            new Fokhagyma(6, Mertekegyseg::GEREZD),
            new Kakukkfu(1, Mertekegyseg::KK),
            new Feherbor(1, Mertekegyseg::DL),
            new PenneTeszta(50, Mertekegyseg::DKG),
            new Csirkemell(50, Mertekegyseg::DKG),
            new ParmezanSajt(10, Mertekegyseg::G),
            new Tejszin(4, Mertekegyseg::DL),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/citromos-spargas-csirkes-penne.recept/';
    }
}
