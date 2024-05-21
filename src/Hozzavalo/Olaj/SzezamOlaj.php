<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Olaj;

use Override;

class SzezamOlaj extends Olaj
{
    #[Override] public static function name(): string
    {
        return 'Szezám olaj';
    }
}
