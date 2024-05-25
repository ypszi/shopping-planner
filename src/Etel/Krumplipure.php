<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Szerecsendio;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Krumpli;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Krumplipure extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Krumplipüré';
    }

    #[Override] protected function listHozzavalok(): array
    {
        return [
            new Krumpli(1, Mertekegyseg::KG),
            // só ízlés szerint
            new So(1, Mertekegyseg::KK),
            // 2dl tej vagy tejföl
            new Tejfol(1, Mertekegyseg::DL),
            new Bors(1, Mertekegyseg::CSIPET),
            new Szerecsendio(1, Mertekegyseg::CSIPET),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/krumplipure-alaprecept.recept/';
    }
}
