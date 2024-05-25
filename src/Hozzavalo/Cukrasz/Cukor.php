<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz;

use Override;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Cukor extends Cukrasz
{
    #[Override] public static function name(): string
    {
        return 'Cukor';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
