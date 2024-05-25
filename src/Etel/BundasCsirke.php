<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\CayenneBors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\FuszerPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\GyomberPor;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Szerecsendio;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Zoldfuszer;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Mez;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Szojaszosz;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BundasCsirke extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Bundás csirke';
    }

    #[Override] protected function listHozzavalok(): array
    {
        return [
            new Fokhagyma(3, Mertekegyseg::GEREZD),
            new NapraforgoOlaj(2, Mertekegyseg::DL),
            new GyomberPor(1.5, Mertekegyseg::TK),
            new Szerecsendio(1, Mertekegyseg::TK),
            new FuszerPaprika(1, Mertekegyseg::TK),
            new Zoldfuszer(1, Mertekegyseg::TK),
            new CayenneBors(0.5, Mertekegyseg::TK),
            new OlivaOlaj(2, Mertekegyseg::EK),
            new Finomliszt(1, Mertekegyseg::BOGRE),
            new Mez(50, Mertekegyseg::ML),
            new Szojaszosz(50, Mertekegyseg::ML),
            new Csirkemell(4, Mertekegyseg::DB),
            new Tojas(3, Mertekegyseg::DB),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/puha-ropogos-fokhagymas-mezes-csirkemell');
    }
}
