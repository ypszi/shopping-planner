<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek;

use Override;

class Turo extends Tejtermek
{
    #[Override] public static function name(): string
    {
        return 'Túró';
    }
}
