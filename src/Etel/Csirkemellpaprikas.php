<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Csirkemellpaprikas extends Etel
{
    public function __construct()
    {
        parent::__construct();

        $this->hozzavalok = [
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::VOROSHAGYMA, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::FOKHAGYMA, 1, Mertekegyseg::GEREZD),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::PARADICSOM, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::PIROS_PAPRIKA, 1, Mertekegyseg::EK),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::FEHERBOR, 1, Mertekegyseg::DL),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::PAPRIKA, 2, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::HUS, Hozzavalo::CSIRKEMELL, 1, Mertekegyseg::KG),
            new Hozzavalo(HozzavaloKategoria::HUTOS, Hozzavalo::TEJFOL, 1, Mertekegyseg::EK),
            new Hozzavalo(HozzavaloKategoria::HUTOS_UTAN, Hozzavalo::TEJSZIN, 1, Mertekegyseg::DL),
        ];
    }

    #[\Override] public static function getName(): string
    {
        return 'Csirkemell paprikás';
    }
}
