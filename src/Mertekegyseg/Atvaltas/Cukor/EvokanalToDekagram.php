<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor;

use PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class EvokanalToDekagram extends MertekegysegValto
{
    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo instanceof Cukor
               && $hozzaadottHozzavalo instanceof Cukor
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::EK
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::DKG;
    }

    protected function getMultiplier(): float
    {
        return 2.0;
    }
}
