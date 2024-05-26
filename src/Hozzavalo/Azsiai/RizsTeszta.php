<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Azsiai;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class RizsTeszta extends Azsiai
{
    public static function name(): string
    {
        return 'Rizs Tészta';
    }

    public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
