<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Pekaru\Kenyer;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Rantotta extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Rántotta';
    }

    #[Override] protected function listHozzavalok(): array
    {
        return [
            new Kenyer(10, Mertekegyseg::DKG),
            new Tojas(6, Mertekegyseg::DB),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::CSIPET),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 2;
    }

    #[Override] public function receptUrl(): string
    {
        return '';
    }
}
