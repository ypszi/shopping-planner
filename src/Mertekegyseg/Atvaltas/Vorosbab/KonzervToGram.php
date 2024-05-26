<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Vorosbab;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\VorosbabKonzerv;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KonzervToGram extends MertekegysegValto
{
    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        return $hozzavalo instanceof VorosbabKonzerv
               && $hozzaadottHozzavalo instanceof VorosbabKonzerv
               && $hozzavalo->getMertekegyseg() === Mertekegyseg::KONZERV
               && $hozzaadottHozzavalo->getMertekegyseg() === Mertekegyseg::G;
    }

    protected function getMultiplier(): float
    {
        return 250.0;
    }
}
