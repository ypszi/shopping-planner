<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Kanal;

use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class KavesKanalToMilliliter extends MertekegysegValto
{
    #[\Override] public function canValt(string $mertekegyseget, string $mertekegysegre): bool
    {
        return $mertekegyseget === Mertekegyseg::KVK
               && $mertekegysegre === Mertekegyseg::ML;
    }

    #[\Override] protected function getMultiplier(): float
    {
        return 5.0;
    }
}
