<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Citrombors;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Lazac;
use PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan\Vaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Brokkoli;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class LazacBrokkolival extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Lazac brokkolival';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Lazac(40, Mertekegyseg::DKG),
            new Brokkoli(1, Mertekegyseg::DB),
            new So(2, Mertekegyseg::CSIPET),
            new Bors(1, Mertekegyseg::CSIPET),
            new Citrombors(1, Mertekegyseg::CSIPET),
            new OlivaOlaj(2, Mertekegyseg::EK),
            new Vaj(1, Mertekegyseg::TK),
            new Petrezselyem(1, Mertekegyseg::MK),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/lazac-brokkolival');
    }
}
