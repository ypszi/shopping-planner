<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Porcukor;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class EvokanalToKilogram extends MertekegysegValto
{
    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Porcukor'
               && $hozzaadottHozzavalo->name() === 'Porcukor'
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::EK
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::KG;
    }

    protected function getMultiplier(): float
    {
        return 0.02;
    }
}
