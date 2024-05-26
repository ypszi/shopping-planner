<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\FinomLiszt;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Finomliszt;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BogreToGram extends MertekegysegValto
{
    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo instanceof Finomliszt
               && $hozzaadottHozzavalo instanceof FinomLiszt
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::BOGRE
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::G;
    }

    protected function getMultiplier(): float
    {
        return 150.0;
    }
}
