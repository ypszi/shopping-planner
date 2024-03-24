<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\FinomLiszt;

use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BogreToKilogram extends MertekegysegValto
{
    #[\Override] public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo instanceof Finomliszt
               && $hozzaadottHozzavalo instanceof Finomliszt
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::BOGRE
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::KG;
    }

    #[\Override] protected function getMultiplier(): float
    {
        return 0.15;
    }
}
