<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Azsiai\Szojaszosz;
use PeterPecosz\Kajatervezo\Hozzavalo\Ecet\BalzsamecetFeher;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Ketchup;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Kemenyito;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Mez;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Gyomber;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class IllatosOmlosCsirkemell extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Illatos omlós csirkemell';
    }

    #[Override] protected function listHozzavalok(): array
    {
        return [
            new Csirkemell(60, Mertekegyseg::DKG),
            new Tojas(3, Mertekegyseg::DB),
            // só ízlés szerint
            new So(1, Mertekegyseg::KK),
            // bors ízlés szerint
            new Bors(1, Mertekegyseg::CSIPET),
            new Kemenyito(5, Mertekegyseg::EK),
            new NapraforgoOlaj(4, Mertekegyseg::DL),
            // A mártáshoz
            new Ketchup(200, Mertekegyseg::ML),
            new BalzsamecetFeher(0.5, Mertekegyseg::DL),
            new Mez(0.5, Mertekegyseg::DL),
            new Szojaszosz(3, Mertekegyseg::EK),
            new Gyomber(1, Mertekegyseg::KK),
            new Fokhagyma(1, Mertekegyseg::GEREZD),
            new Voroshagyma(1, Mertekegyseg::DB),
            // só ízlés szerint
            new So(1, Mertekegyseg::CSIPET),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/illatos-omlos-csirkemell');
    }
}
