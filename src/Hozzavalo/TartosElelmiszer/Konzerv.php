<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

abstract class Konzerv extends TartosElelmiszer
{
    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::G;
    }
}
