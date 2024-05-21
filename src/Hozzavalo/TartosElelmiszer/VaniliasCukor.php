<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use Override;

class VaniliasCukor extends TartosElelmiszer
{
    #[Override] public static function name(): string
    {
        return 'Vaníliás cukor';
    }
}
