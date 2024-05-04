<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Fozotejszin extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Főzőtejszín';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::ML;
    }
}
