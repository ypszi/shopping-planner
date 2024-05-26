<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Finomliszt extends TartosElelmiszer
{
    public static function name(): string
    {
        return 'Finomliszt';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
