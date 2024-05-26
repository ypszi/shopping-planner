<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Cukor extends Cukrasz
{
    public static function name(): string
    {
        return 'Cukor';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
