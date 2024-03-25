<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\So;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Szerecsendio;
use PeterPecosz\Kajatervezo\Hozzavalo\Hutos\MozzarellaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan\Vaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Edesburgonya;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class EdesburgonyaPure extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Édesburgonya püré';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Edesburgonya(30, Mertekegyseg::DKG),
            new So(1, Mertekegyseg::CSIPET),
            new Vaj(5, Mertekegyseg::DKG),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new Szerecsendio(1, Mertekegyseg::KH),
            new MozzarellaSajt(5, Mertekegyseg::DKG),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 2;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/edesburgonya-pure.recept/';
    }
}
