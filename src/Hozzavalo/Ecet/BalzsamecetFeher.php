<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Ecet;

use Override;

class BalzsamecetFeher extends Ecet
{
    #[Override] public static function name(): string
    {
        return 'Balzsamecet (fehér)';
    }
}
