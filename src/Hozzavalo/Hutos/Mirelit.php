<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hutos;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

abstract class Mirelit extends Hutos
{
    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::G;
    }
}
