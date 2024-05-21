<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg;

use Override;

class HegyesPaprika extends Zoldseg
{
    #[Override] public static function name(): string
    {
        return 'Hegyes paprika';
    }
}
