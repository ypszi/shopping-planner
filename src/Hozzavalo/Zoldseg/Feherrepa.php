<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Feherrepa extends Zoldseg
{
    #[\Override] public static function name(): string
    {
        return 'Fehérrépa';
    }
}
