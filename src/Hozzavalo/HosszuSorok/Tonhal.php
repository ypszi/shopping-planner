<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Tonhal extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Tonhal';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::G;
    }
}
