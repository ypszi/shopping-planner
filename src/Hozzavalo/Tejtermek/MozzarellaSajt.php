<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek;

use Override;

class MozzarellaSajt extends Tejtermek
{
    #[Override] public static function name(): string
    {
        return 'Mozzarella sajt';
    }
}
