<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class PirosPaprika extends FuszerEsOlaj
{
    #[\Override] public static function name(): string
    {
        return 'Piros paprika';
    }
}
