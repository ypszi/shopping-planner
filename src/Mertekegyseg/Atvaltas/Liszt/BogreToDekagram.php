<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Liszt;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BogreToDekagram extends MertekegysegValto
{
    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Liszt'
               && $hozzaadottHozzavalo->name() === 'Liszt'
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::BOGRE
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::DKG;
    }

    protected function getMultiplier(): float
    {
        return 15.0;
    }
}
