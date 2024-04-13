<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class SzezamOlaj extends FuszerEsOlaj
{
    #[\Override] public static function name(): string
    {
        return 'Szezám olaj';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::DL;
    }
}
