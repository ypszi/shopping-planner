<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Citrom;
use PeterPecosz\Kajatervezo\Hozzavalo\Feherrepa;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Karalabe;
use PeterPecosz\Kajatervezo\Hozzavalo\Sargarepa;
use PeterPecosz\Kajatervezo\Hozzavalo\Voroshagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zeller;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldborso;
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
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::NAPRAFORGO_OLAJ, 3, Mertekegyseg::EK),
            new Sargarepa(3, Mertekegyseg::DB),
            new Feherrepa(2, Mertekegyseg::DB),
            new Karalabe(1, Mertekegyseg::DB),
            new Zeller(1, Mertekegyseg::DB),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Zoldborso(30, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::TARKONY, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::FOZO_TEJSZIN, 3, Mertekegyseg::DL),
            new Citrom(1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::EROLEVES_KOCKA, 4, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::PETREZSELYEM, 3, Mertekegyseg::EK),
        ];
    }

    #[\Override] public function receptUrl(): string
    {
        return sprintf('https://www.nosalty.hu/recept/tarkonyos-csirkeraguleves-tarkonyos-raguleves-3?adag=%d', $this->adag);
    }
}
