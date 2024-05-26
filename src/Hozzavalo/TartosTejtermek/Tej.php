<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Tej extends TartosTejtermek
{
    public static function name(): string
    {
        return 'Tej';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::L;
    }
}
