<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
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
            new Hozzavalo(Hozzavalo::FINOMLISZT, 4, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::SUTOPOR, 1, Mertekegyseg::KK),
            new Hozzavalo(Hozzavalo::PORCUKOR, 4, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::KAKAOPOR, 2, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::TOJAS, 1, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::TEJ, 3, Mertekegyseg::EK),
            new NapraforgoOlaj(3, Mertekegyseg::EK),
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
        return sprintf('https://www.nosalty.hu/recept/bogreben-sult-suti-5-perc-alatt?adag=%d', $this->adag);
    }
}
