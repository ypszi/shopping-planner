<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\So;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Kenyer;
use PeterPecosz\Kajatervezo\Hozzavalo\Hutos\Tojas;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Rantotta extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Rántotta';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Kenyer(10, Mertekegyseg::DKG),
            new Tojas(6, Mertekegyseg::DB),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::CSIPET),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 2;
    }

    #[\Override] public function receptUrl(): string
    {
        return '';
    }
}
