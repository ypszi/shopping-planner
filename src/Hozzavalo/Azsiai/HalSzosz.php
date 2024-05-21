<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Azsiai;

use Override;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class HalSzosz extends Azsiai
{
    #[Override] public static function name(): string
    {
        return 'Hal Szósz';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::ML;
    }
}
