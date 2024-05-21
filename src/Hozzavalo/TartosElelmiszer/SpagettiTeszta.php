<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use Override;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class SpagettiTeszta extends TartosElelmiszer
{
    #[Override] public static function name(): string
    {
        return 'Spagetti tészta';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
