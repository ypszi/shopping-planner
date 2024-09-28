<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\FinomLiszt;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BogreToKilogram extends MertekegysegValto
{
    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Finomliszt'
               && $hozzaadottHozzavalo->name() === 'Finomliszt'
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::BOGRE
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::KG;
    }

    protected function getMultiplier(): float
    {
        return 0.15;
    }
}
