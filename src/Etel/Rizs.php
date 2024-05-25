<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Rizs as HozzavaloRizs;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Rizs extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Rizs';
    }

    #[Override] protected function listHozzavalok(): array
    {
        return [
            new HozzavaloRizs(200, Mertekegyseg::G),
            new So(1, Mertekegyseg::KK),
            new Bors(1, Mertekegyseg::CSIPET),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[Override] public function receptUrl(): string
    {
        return '';
    }
}
