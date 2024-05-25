<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Felvagott;

use Override;

class Virsli extends Felvagott
{
    #[Override] public static function name(): string
    {
        return 'Virsli';
    }
}
