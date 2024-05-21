<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Bor;

use Override;

class Feherbor extends Bor
{
    #[Override] public static function name(): string
    {
        return 'Fehérbor';
    }
}
