<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Porcukor extends Cukrasz
{
    public static function name(): string
    {
        return 'Porcukor';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::G;
    }
}
