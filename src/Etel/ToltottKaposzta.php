<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Baberlevel;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Fuszerkomeny;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\FuszerPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Rizs;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Kaposzta;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\SavanyuKaposzta;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
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
            new SavanyuKaposzta(1, Mertekegyseg::KG),
            new Kaposzta(1, Mertekegyseg::DB),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new FuszerPaprika(3, Mertekegyseg::TK),
            new Fuszerkomeny(1, Mertekegyseg::TK),
            new Baberlevel(5, Mertekegyseg::DB),
            new Rizs(20, Mertekegyseg::DKG),
            new Finomliszt(1, Mertekegyseg::EK),
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
