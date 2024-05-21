<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use Override;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class RizottoRizs extends TartosElelmiszer
{
    #[Override] public static function name(): string
    {
        return 'Rizottó rizs';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
