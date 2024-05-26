<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Tejfol extends Tejtermek
{
    public static function name(): string
    {
        return 'Tejföl';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::G;
    }
}
