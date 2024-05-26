<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\So;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KaveskanalToGram extends MertekegysegValto
{
    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo instanceof So
               && $hozzaadottHozzavalo instanceof So
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::KVK
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::G;
    }

    protected function getMultiplier(): float
    {
        return 2.0;
    }
}
