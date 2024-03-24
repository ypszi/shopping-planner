<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Chili;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Kemenyito;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Mez;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Sutopor;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Szezammag;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
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
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::TOJAS, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::KETCHUP, 100, Mertekegyseg::G),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return sprintf('https://www.nosalty.hu/recept/kinai-szezammagos-csirke?adag=%d', $this->adag);
    }
}
