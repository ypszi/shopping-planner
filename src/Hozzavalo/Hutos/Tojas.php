<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hutos;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Tojas extends Hutos
{
    #[\Override] public static function name(): string
    {
        return 'Tojás';
    }
}
