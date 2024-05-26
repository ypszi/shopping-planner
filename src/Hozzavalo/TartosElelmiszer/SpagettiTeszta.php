<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class SpagettiTeszta extends TartosElelmiszer
{
    public static function name(): string
    {
        return 'Spagetti tészta';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
