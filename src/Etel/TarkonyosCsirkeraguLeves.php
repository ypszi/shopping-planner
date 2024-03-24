<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\ErolevesKocka;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Tarkony;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Citrom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Feherrepa;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Karalabe;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Sargarepa;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Zeller;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Zoldborso;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TarkonyosCsirkeraguLeves extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Tárkonyos csirkeraguleves';
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Csirkemell(1, Mertekegyseg::DB),
            new NapraforgoOlaj(3, Mertekegyseg::EK),
            new Sargarepa(3, Mertekegyseg::DB),
            new Feherrepa(2, Mertekegyseg::DB),
            new Karalabe(1, Mertekegyseg::DB),
            new Zeller(1, Mertekegyseg::DB),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Zoldborso(30, Mertekegyseg::DKG),
            new Tarkony(1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::FOZO_TEJSZIN, 3, Mertekegyseg::DL),
            new Citrom(1, Mertekegyseg::DB),
            new ErolevesKocka(4, Mertekegyseg::DB),
            new Petrezselyem(3, Mertekegyseg::EK),
        ];
    }

    #[\Override] public function receptUrl(): string
    {
        return sprintf('https://www.nosalty.hu/recept/tarkonyos-csirkeraguleves-tarkonyos-raguleves-3?adag=%d', $this->adag);
    }
}
