<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class OlivaOlaj extends FuszerEsOlaj
{
    #[\Override] public static function name(): string
    {
        return 'Olíva olaj';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::DL;
    }
}
