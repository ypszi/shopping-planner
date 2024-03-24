<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Brokkoli extends Hozzavalo
{
    #[\Override] public static function name(): string
    {
        return 'Brokkoli';
    }
}
