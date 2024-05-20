<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Kakaopor;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Porcukor;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Sutopor;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan\Tej;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BogresSuti extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Bögrés süti';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Finomliszt(4, Mertekegyseg::EK),
            new Sutopor(1, Mertekegyseg::KK),
            // 4 EK helyett
            new Porcukor(2, Mertekegyseg::EK),
            new Kakaopor(2, Mertekegyseg::EK),
            new Tojas(1, Mertekegyseg::DB),
            new Tej(3, Mertekegyseg::EK),
            // 3 EK helyett
            new NapraforgoOlaj(1, Mertekegyseg::EK),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 2;
    }

    /**
     * 2 perc mikro
     */
    #[\Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/bogreben-sult-suti-5-perc-alatt');
    }
}
