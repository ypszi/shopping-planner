<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Chili;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class ChilisBab extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Chilis bab';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Voroshagyma(2, Mertekegyseg::DB),
            new NapraforgoOlaj(3, Mertekegyseg::EK),
            new Fokhagyma(4, Mertekegyseg::GEREZD),
            new PirosPaprika(1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::DARALT_HUS, 50, Mertekegyseg::DKG),
            new Hozzavalo(Hozzavalo::PARADICSOM_PURE, 10, Mertekegyseg::DKG),
            new Chili(1, Mertekegyseg::TK),
            new Hozzavalo(Hozzavalo::VOROSBAB, 2, Mertekegyseg::KONZERV),
            new Hozzavalo(Hozzavalo::KUKORICA, 1, Mertekegyseg::KONZERV),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/chilis-bab.recept/';
    }
}
