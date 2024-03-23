<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KinaiSzezammagosCsirke extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Kínai szezámmagos csirke';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Hozzavalo(Hozzavalo::NAPRAFORGO_OLAJ, 1, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::NAPRAFORGO_OLAJ, 3, Mertekegyseg::DL),
            // chili ízlés szerint
            new Hozzavalo(Hozzavalo::CHILI, 1, Mertekegyseg::MK),
            new Hozzavalo(Hozzavalo::SUTOPOR, 1.5, Mertekegyseg::KK),
            new Hozzavalo(Hozzavalo::KEMENYITO, 3, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::MEZ, 2, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::SZEZAMMAG, 3, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::FINOMLISZT, 6, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::TOJAS, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::KETCHUP, 100, Mertekegyseg::G),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return sprintf('https://www.nosalty.hu/recept/kinai-szezammagos-csirke?adag=%d', $this->adag);
    }
}
