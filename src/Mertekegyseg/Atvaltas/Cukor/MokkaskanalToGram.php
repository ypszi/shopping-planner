<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Cukor;

use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class MokkaskanalToGram extends MertekegysegValto
{
    #[\Override] public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo instanceof Cukor
               && $hozzaadottHozzavalo instanceof Cukor
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::MK
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::G;
    }

    #[\Override] protected function getMultiplier(): float
    {
        return 2.0;
    }
}
