<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class NapraforgoOlaj extends FuszerEsOlaj
{
    #[\Override] public static function name(): string
    {
        return 'Napraforgó olaj';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::DL;
    }
}
