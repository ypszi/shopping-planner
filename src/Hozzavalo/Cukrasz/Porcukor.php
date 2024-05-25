<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz;

use Override;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Porcukor extends Cukrasz
{
    #[Override] public static function name(): string
    {
        return 'Porcukor';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::G;
    }
}
