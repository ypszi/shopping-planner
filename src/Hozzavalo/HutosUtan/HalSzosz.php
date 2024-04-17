<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class HalSzosz extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Hal Szósz';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::ML;
    }
}
