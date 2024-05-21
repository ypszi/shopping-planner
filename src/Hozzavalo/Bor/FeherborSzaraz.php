<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Bor;

use Override;

class FeherborSzaraz extends Feherbor
{
    #[Override] public static function name(): string
    {
        return parent::name() . ' (száraz)';
    }
}
