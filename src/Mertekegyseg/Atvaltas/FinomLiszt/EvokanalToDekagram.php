<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\FinomLiszt;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class EvokanalToDekagram extends MertekegysegValto
{
    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Finomliszt'
               && $hozzaadottHozzavalo->name() === 'Finomliszt'
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::EK
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::DKG;
    }

    protected function getMultiplier(): float
    {
        return 2.0;
    }
}
