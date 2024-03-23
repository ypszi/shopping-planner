<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
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
            new Hozzavalo(Hozzavalo::SARGAREPA, 3, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::FEHERREPA, 2, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::KARALABE, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::ZELLER, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::VOROSHAGYMA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::ZOLDBORSO, 30, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::TARKONY, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::FOZO_TEJSZIN, 3, Mertekegyseg::DL),
            new Hozzavalo(Hozzavalo::CITROM, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::EROLEVES_KOCKA, 4, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::PETREZSELYEM, 3, Mertekegyseg::EK),
        ];
    }

    #[\Override] public function receptUrl(): string
    {
        return sprintf('https://www.nosalty.hu/recept/tarkonyos-csirkeraguleves-tarkonyos-raguleves-3?adag=%d', $this->adag);
    }
}
