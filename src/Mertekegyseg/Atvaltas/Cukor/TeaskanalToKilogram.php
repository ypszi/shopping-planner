<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor;

use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TeaskanalToKilogram extends MertekegysegValto
{
    #[\Override] public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo instanceof Cukor
               && $hozzaadottHozzavalo instanceof Cukor
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::TK
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::KG;
    }

    #[\Override] protected function getMultiplier(): float
    {
        return 0.006;
    }
}
