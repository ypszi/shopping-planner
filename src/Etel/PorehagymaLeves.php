<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class PorehagymaLeves extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Póréhagyma leves';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(Hozzavalo::POREHAGYMA, 2, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::KRUMPLI, 2, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::ZELLERSZAR, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::HUSLEVES_KOCKA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::VAJ, 3, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::HABTEJSZIN, 200, Mertekegyseg::ML),
        ];
    }

    #[\Override] public static function getDefaultAdag(): int
    {
        return 4;
    }
}
