<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use Override;

class Kakaopor extends TartosElelmiszer
{
    #[Override] public static function name(): string
    {
        return 'Kakaópor';
    }
}
