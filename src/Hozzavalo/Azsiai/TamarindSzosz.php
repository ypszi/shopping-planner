<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Azsiai;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TamarindSzosz extends Azsiai
{
    #[\Override] public static function name(): string
    {
        return 'Tamarind Szósz';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::ML;
    }
}
