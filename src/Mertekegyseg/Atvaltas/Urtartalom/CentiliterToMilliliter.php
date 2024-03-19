<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Urtartalom;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class CentiliterToMilliliter extends MertekegysegValto
{
    #[\Override] public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->getMertekegyseg() === Mertekegyseg::CL
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::ML;
    }

    #[\Override] protected function getMultiplier(): float
    {
        return 10.0;
    }
}
