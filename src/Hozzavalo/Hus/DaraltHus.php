<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

use Override;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class DaraltHus extends Hus
{
    #[Override] public static function name(): string
    {
        return 'Darált hús';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::KG;
    }
}
