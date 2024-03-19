<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class MilliliterToCentiliter extends MertekegysegValto
{
    #[\Override] public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->getMertekegyseg() === Mertekegyseg::ML
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::CL;
    }

    #[\Override] protected function getMultiplier(): float
    {
        return 0.1;
    }
}
