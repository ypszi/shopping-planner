<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hutos;

class ParmezanSajt extends Hutos
{
    #[\Override] public static function name(): string
    {
        return 'Parmezán sajt';
    }
}
