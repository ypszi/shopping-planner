<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

use Override;

class BaconSzeletelt extends Hus
{
    #[Override] public static function name(): string
    {
        return 'Bacon (szeletelt)';
    }
}
