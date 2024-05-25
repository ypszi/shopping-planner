<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Szerecsendio;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\MozzarellaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Vaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Edesburgonya;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class EdesburgonyaPure extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Édesburgonya püré';
    }

    #[Override] protected function listHozzavalok(): array
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

    #[Override] public static function defaultAdag(): int
    {
        return 2;
    }

    #[Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/edesburgonya-pure.recept/';
    }
}
