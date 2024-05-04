<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Felvagott extends Hus
{
    #[\Override] public static function name(): string
    {
        return 'Felvágott';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::DKG;
    }
}
