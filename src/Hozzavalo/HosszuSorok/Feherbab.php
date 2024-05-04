<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Feherbab extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Fehérbab';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::G;
    }
}
