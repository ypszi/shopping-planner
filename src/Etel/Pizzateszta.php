<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Eleszto;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Finomliszt;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Pizzateszta extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Pizzatészta';
    }

    #[Override] protected static function listHozzavalok(): array
    {
        return [
            new Finomliszt(500, Mertekegyseg::G),
            new So(0.5, Mertekegyseg::EK),
            new Cukor(0.5, Mertekegyseg::EK),
            new OlivaOlaj(2, Mertekegyseg::EK),
            new Eleszto(7, Mertekegyseg::G),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 2;
    }

    #[Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/pizzateszta-jamie-oliver-tol');
    }
}
