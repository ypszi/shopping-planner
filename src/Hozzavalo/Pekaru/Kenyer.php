<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Pekaru;

use Override;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Kenyer extends Pekaru
{
    #[Override] public static function name(): string
    {
        return 'Kenyér';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
