<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Pekaru;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Kenyer extends Pekaru
{
    public static function name(): string
    {
        return 'Kenyér';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
