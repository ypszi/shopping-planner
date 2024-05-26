<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Csirkemell extends Hus
{
    public static function name(): string
    {
        return 'Csirkemell';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
