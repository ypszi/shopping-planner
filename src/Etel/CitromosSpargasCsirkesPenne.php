<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class CitromosSpargasCsirkesPenne extends Etel
{
    public function __construct()
    {
        parent::__construct();

        $this->hozzavalok = [
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::VOROSHAGYMA, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::CITROM, 1, Mertekegyseg::DB),
            new Hozzavalo(HozzavaloKategoria::ZOLDSEG, Hozzavalo::FOKHAGYMA, 6, Mertekegyseg::GEREZD),
            new Hozzavalo(HozzavaloKategoria::FUSZER_ES_OLAJ, Hozzavalo::KAKUKKFU, 1, Mertekegyseg::KK),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::FEHERBOR, 1, Mertekegyseg::DL),
            new Hozzavalo(HozzavaloKategoria::HOSSZU_SOROK, Hozzavalo::PENNE_TESZTA, 50, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::HUS, Hozzavalo::CSIRKEMELL, 50, Mertekegyseg::DKG),
            new Hozzavalo(HozzavaloKategoria::HUTOS, Hozzavalo::PARMEZAN, 10, Mertekegyseg::G),
            new Hozzavalo(HozzavaloKategoria::HUTOS_UTAN, Hozzavalo::TEJSZIN, 4, Mertekegyseg::DL),
        ];
    }

    #[\Override] public static function getName(): string
    {
        return 'Citromos Spárgás Csirkés Penne';
    }
}
