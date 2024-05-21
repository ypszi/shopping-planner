<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Azsiai;

use Override;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class RizsTeszta extends Azsiai
{
    #[Override] public static function name(): string
    {
        return 'Rizs Tészta';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
