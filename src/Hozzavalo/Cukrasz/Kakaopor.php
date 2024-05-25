<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz;

use Override;

class Kakaopor extends Cukrasz
{
    #[Override] public static function name(): string
    {
        return 'Kakaópor';
    }
}
