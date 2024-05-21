<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek;

use Override;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Tejfol extends Tejtermek
{
    #[Override] public static function name(): string
    {
        return 'Tejföl';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::G;
    }
}
