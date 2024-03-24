<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Citrom;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Rizskoch extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Rizskoch';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Citrom(0.5, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::RIZS, 250, Mertekegyseg::G),
            new Hozzavalo(Hozzavalo::VANILIAS_CUKOR, 250, Mertekegyseg::G),
            new Hozzavalo(Hozzavalo::CUKOR, 130, Mertekegyseg::G),
            // porcukor ízlés szerint
            new Hozzavalo(Hozzavalo::PORCUKOR, 100, Mertekegyseg::G),
            // baracklekvár ízlés szerint
            new Hozzavalo(Hozzavalo::BARACK_LEKVAR, 150, Mertekegyseg::G),
            new Hozzavalo(Hozzavalo::TOJAS, 5, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::TEJ, 8, Mertekegyseg::DL),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://streetkitchen.hu/meguszos-sutik/rizskoch-baracklekvarral/';
    }
}
