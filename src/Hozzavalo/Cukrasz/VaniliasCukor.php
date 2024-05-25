<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz;

use Override;

class VaniliasCukor extends Cukrasz
{
    #[Override] public static function name(): string
    {
        return 'Vaníliás cukor';
    }
}
