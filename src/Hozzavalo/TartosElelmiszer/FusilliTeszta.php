<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class FusilliTeszta extends TartosElelmiszer
{
    public static function name(): string
    {
        return 'Fusilli tészta';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
