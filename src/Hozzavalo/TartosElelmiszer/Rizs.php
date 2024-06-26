<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Rizs extends TartosElelmiszer
{
    public static function name(): string
    {
        return 'Rizs';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
