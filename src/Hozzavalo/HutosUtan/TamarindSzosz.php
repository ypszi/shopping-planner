<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TamarindSzosz extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Tamarind Szósz';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::ML;
    }
}
