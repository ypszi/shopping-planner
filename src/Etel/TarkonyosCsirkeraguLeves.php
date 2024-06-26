<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\ErolevesKocka;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Tarkony;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Mirelit\ZoldborsoMirelit;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Fozotejszin;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Citrom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Feherrepa;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Karalabe;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Sargarepa;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Zeller;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TarkonyosCsirkeraguLeves extends Etel
{
    public static function name(): string
    {
        return 'Tárkonyos csirkeraguleves';
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    protected function listHozzavalok(): array
    {
        return [
            new Csirkemell(1, Mertekegyseg::DB),
            new NapraforgoOlaj(3, Mertekegyseg::EK),
            new Sargarepa(3, Mertekegyseg::DB),
            new Feherrepa(2, Mertekegyseg::DB),
            new Karalabe(1, Mertekegyseg::DB),
            new Zeller(1, Mertekegyseg::DB),
            new Voroshagyma(1, Mertekegyseg::DB),
            new ZoldborsoMirelit(30, Mertekegyseg::DKG),
            new Tarkony(1, Mertekegyseg::EK),
            new Fozotejszin(3, Mertekegyseg::DL),
            new Citrom(1, Mertekegyseg::DB),
            new ErolevesKocka(4, Mertekegyseg::DB),
            new Petrezselyem(3, Mertekegyseg::EK),
        ];
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/tarkonyos-csirkeraguleves-tarkonyos-raguleves-3';
    }
}
