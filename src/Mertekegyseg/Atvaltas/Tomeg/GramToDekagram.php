<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tomeg;

use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class GramToDekagram extends MertekegysegValto
{
    #[\Override] public function canValt(string $mertekegyseget, string $mertekegysegre): bool
    {
        return $mertekegyseget === Mertekegyseg::G
               && $mertekegysegre === Mertekegyseg::DKG;
    }

    #[\Override] protected function getMultiplier(): float
    {
        return 0.1;
    }
}
