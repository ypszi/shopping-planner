<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Udito;

class Szodaviz extends Udito
{
    #[\Override] public static function name(): string
    {
        return 'Szodavíz';
    }
}
