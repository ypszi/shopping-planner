<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\FuszerPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Kolbasz;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Virsli;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Burgonya;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class PaprikasKrumpli extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Paprikás krumpli';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Burgonya(1, Mertekegyseg::KG),
            new Kolbasz(15, Mertekegyseg::DKG),
            new Virsli(20, Mertekegyseg::DKG),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new OlivaOlaj(4, Mertekegyseg::EK),
            new FuszerPaprika(2, Mertekegyseg::TK),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::MK),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/paprikas-krumpli-kolbasszal');
    }
}
