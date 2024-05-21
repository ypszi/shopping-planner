<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek;

use Override;

class ParmezanSajt extends Tejtermek
{
    #[Override] public static function name(): string
    {
        return 'Parmezán sajt';
    }
}
