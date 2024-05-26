<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class DaraltHus extends Hus
{
    public static function name(): string
    {
        return 'Darált hús';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
