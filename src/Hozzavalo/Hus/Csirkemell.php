<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

use Override;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Csirkemell extends Hus
{
    #[Override] public static function name(): string
    {
        return 'Csirkemell';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
