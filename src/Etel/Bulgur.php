<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Bulgur extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Bulgur';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(Hozzavalo::BULGUR, 30, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::VOROSHAGYMA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::PARADICSOM, 2, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::PAPRIKA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::OLIVA_OLAJ, 2, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::HUSLEVES_KOCKA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::SO, 0.5, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::BORS, 1, Mertekegyseg::CSIPET),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://eletszepitok.hu/igy-keszul-a-paradicsomos-bulgur-azaz-a-torok-rizs/';
    }
}
