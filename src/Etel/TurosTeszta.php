<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\CsuszaTeszta;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\KolozsvariSzalonna;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Turo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TurosTeszta extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Túrós tészta';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new CsuszaTeszta(500, Mertekegyseg::G),
            new So(1, Mertekegyseg::CSIPET),
            new KolozsvariSzalonna(200, Mertekegyseg::G),
            new Tejfol(200, Mertekegyseg::G),
            new Turo(200, Mertekegyseg::G),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/turos-teszta-alaprecept');
    }
}
