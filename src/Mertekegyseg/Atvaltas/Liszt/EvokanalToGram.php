<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Liszt;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class EvokanalToGram extends MertekegysegValto
{
    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Liszt'
               && $hozzaadottHozzavalo->name() === 'Liszt'
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::EK
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::G;
    }

    protected function getMultiplier(): float
    {
        return 20.0;
    }
}
