<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;

class SzezammagosCsirke extends KinaiSzezammagosCsirke
{
    #[Override] public static function name(): string
    {
        return 'Szezámmagos csirke';
    }
}
