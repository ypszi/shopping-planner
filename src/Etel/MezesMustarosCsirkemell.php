<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\FuszerPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Mustar;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Liszt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Mez;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class MezesMustarosCsirkemell extends Etel
{
    public static function name(): string
    {
        return 'Mézes-mustáros csirkemell';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Csirkemell(50, Mertekegyseg::DKG),
            new Liszt(3, Mertekegyseg::EK),
            new OlivaOlaj(3, Mertekegyseg::EK),
            // 3 dl víz
            new Fokhagyma(3, Mertekegyseg::GEREZD),
            new So(1, Mertekegyseg::KK),
            new FuszerPaprika(1, Mertekegyseg::TK),
            new Mez(5, Mertekegyseg::EK),
            new Mustar(5, Mertekegyseg::EK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 2;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.mindmegette.hu/mezes-mustaros-csirkemell-video.recept/';
    }
}
