<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class ToltottKaposzta extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Töltött káposzta';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(Hozzavalo::SAVANYU_KAPOSZTA, 1, Mertekegyseg::KG),
            new Hozzavalo(Hozzavalo::KAPOSZTA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::VOROSHAGYMA, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::FOKHAGYMA, 2, Mertekegyseg::GEREZD),
            new Hozzavalo(Hozzavalo::FUSZER_PAPRIKA, 3, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::FUSZERKOMENY, 1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::BABERLEVEL, 5, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::RIZS, 20, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::FINOMLISZT, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::DARALT_HUS, 50, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::KOLOZSVARI_SZALONNA, 20, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::KOLBASZ, 20, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::SERTES_ZSIR, 1, Mertekegyseg::EK),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 8;
    }

    #[\Override] public function receptUrl(): string
    {
        return sprintf('https://www.nosalty.hu/recept/klasszikus-toltott-kaposzta?adag=%d', $this->adag);
    }
}
