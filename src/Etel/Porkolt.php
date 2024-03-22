<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Porkolt extends Etel
{
    #[\Override] public static function getName(): string
    {
        return 'Pörkölt';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(Hozzavalo::SERTESCOMB, 1, Mertekegyseg::KG),
            new Hozzavalo(Hozzavalo::VOROSHAGYMA, 4, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::FOKHAGYMA, 4, Mertekegyseg::GEREZD),
            new Hozzavalo(Hozzavalo::PARADICSOM, 2, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::PAPRIKA, 2, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::HEGYES_PAPRIKA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::OLIVA_OLAJ, 6, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::FUSZERKOMENY, 1, Mertekegyseg::KVK),
            new Hozzavalo(Hozzavalo::SO, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::GULYAS_KREM, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::PIROS_PAPRIKA, 1, Mertekegyseg::EK),
        ];
    }

    #[\Override] public static function getDefaultAdag(): int
    {
        return 4;
    }
}
