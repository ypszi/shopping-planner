<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Chili;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Ketchup;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Csirkemell;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Kemenyito;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Mez;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Sutopor;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Szezammag;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KinaiSzezammagosCsirke extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Kínai szezámmagos csirke';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            // a bundához
            new NapraforgoOlaj(1, Mertekegyseg::EK),
            // a sütéshez
            new NapraforgoOlaj(3, Mertekegyseg::DL),
            // chili ízlés szerint
            new Chili(1, Mertekegyseg::MK),
            new Sutopor(1.5, Mertekegyseg::KK),
            new Kemenyito(3, Mertekegyseg::EK),
            new Mez(2, Mertekegyseg::TK),
            new Szezammag(3, Mertekegyseg::EK),
            new Finomliszt(6, Mertekegyseg::EK),
            new Csirkemell(1, Mertekegyseg::DB),
            new Tojas(1, Mertekegyseg::DB),
            new Ketchup(100, Mertekegyseg::G),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/kinai-szezammagos-csirke');
    }
}
