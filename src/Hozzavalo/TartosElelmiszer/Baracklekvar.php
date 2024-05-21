<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use Override;

class Baracklekvar extends TartosElelmiszer
{
    #[Override] public static function name(): string
    {
        return 'Baracklekvár';
    }
}
