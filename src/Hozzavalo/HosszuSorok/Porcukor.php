<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Porcukor extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Porcukor';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::G;
    }
}
