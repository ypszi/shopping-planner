<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KavesKanalToTeasKanal extends MertekegysegValto
{
    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->getMertekegyseg() === Mertekegyseg::KVK
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::TK;
    }

    protected function getMultiplier(): float
    {
        return 1.0;
    }
}
