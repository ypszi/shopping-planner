<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Tomeg;

use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KilogramToGram extends MertekegysegValto
{
    #[\Override] public function canValt(string $mertekegyseget, string $mertekegysegre): bool
    {
        return $mertekegyseget === Mertekegyseg::KG
               && $mertekegysegre === Mertekegyseg::G;
    }

    #[\Override] protected function getMultiplier(): float
    {
        return 1000.0;
    }
}
