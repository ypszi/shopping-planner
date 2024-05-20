<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek;

class ParmezanSajt extends Tejtermek
{
    #[\Override] public static function name(): string
    {
        return 'Parmezán sajt';
    }
}
