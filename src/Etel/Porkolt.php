<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\HegyesPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Paprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Paradicsom;
use PeterPecosz\Kajatervezo\Hozzavalo\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Porkolt extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Pörkölt';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(Hozzavalo::SERTESCOMB, 1, Mertekegyseg::KG),
            new Voroshagyma(4, Mertekegyseg::DB),
            new Fokhagyma(4, Mertekegyseg::GEREZD),
            new Paradicsom(2, Mertekegyseg::DB),
            new Paprika(2, Mertekegyseg::DB),
            new HegyesPaprika(1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::OLIVA_OLAJ, 6, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::FUSZERKOMENY, 1, Mertekegyseg::KVK),
            new Hozzavalo(Hozzavalo::SO, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::GULYAS_KREM, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::PIROS_PAPRIKA, 1, Mertekegyseg::EK),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/klasszikus-sertesporkolt.recept/';
    }
}
