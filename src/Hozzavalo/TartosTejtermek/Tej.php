<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Tej extends TartosTejtermek
{
    #[\Override] public static function name(): string
    {
        return 'Tej';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::L;
    }
}
