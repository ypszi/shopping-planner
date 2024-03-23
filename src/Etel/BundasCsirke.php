<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BundasCsirke extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Bundás csirke';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Fokhagyma(3, Mertekegyseg::GEREZD),
            new Hozzavalo(Hozzavalo::NAPRAFORGO_OLAJ, 2, Mertekegyseg::DL),
            new Hozzavalo(Hozzavalo::GYOMBER_POR, 1.5, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::SZERECSENDIO, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::FUSZER_PAPRIKA, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::ZOLDFUSZER, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::CAYENNE_BORS, 0.5, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::OLIVA_OLAJ, 2, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::FINOMLISZT, 1, Mertekegyseg::BOGRE),
            new Hozzavalo(Hozzavalo::MEZ, 50, Mertekegyseg::ML),
            new Hozzavalo(Hozzavalo::SZOJASZOSZ, 50, Mertekegyseg::ML),
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 4, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::TOJAS, 3, Mertekegyseg::DB),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return sprintf('https://www.nosalty.hu/recept/puha-ropogos-fokhagymas-mezes-csirkemell?adag=%d', $this->adag);
    }
}
