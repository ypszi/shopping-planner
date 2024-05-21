<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek;

use Override;

class NaturJoghurt extends Tejtermek
{
    #[Override] public static function name(): string
    {
        return 'Natúr joghurt';
    }
}
