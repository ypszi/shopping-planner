<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\So;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TeaskanalToGram extends MertekegysegValto
{
    #[\Override] public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo instanceof So
               && $hozzaadottHozzavalo instanceof So
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::TK
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::G;
    }

    #[\Override] protected function getMultiplier(): float
    {
        return 8.0;
    }
}
