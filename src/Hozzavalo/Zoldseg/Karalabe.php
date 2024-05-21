<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg;

use Override;

class Karalabe extends Zoldseg
{
    #[Override] public static function name(): string
    {
        return 'Karalabé';
    }
}
