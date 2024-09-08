<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Szerecsendio;
use PeterPecosz\Kajatervezo\Hozzavalo\Sajt\MozzarellaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Vaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Edesburgonya;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class EdesburgonyaPure extends Etel
{
    public static function name(): string
    {
        return 'Édesburgonya püré';
    }

    protected function listHozzavalok(): array
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

    public static function defaultAdag(): int
    {
        return 2;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.mindmegette.hu/edesburgonya-pure.recept/';
    }

    public function thumbnailUrl(): string
    {
        return 'https://www.mindmegette.hu/images/398/Social/lead_Social_edesburgonya-pure-recept.jpeg';
    }
}
