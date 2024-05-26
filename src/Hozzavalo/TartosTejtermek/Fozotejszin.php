<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Fozotejszin extends TartosTejtermek
{
    public static function name(): string
    {
        return 'Főzőtejszín';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::ML;
    }
}
