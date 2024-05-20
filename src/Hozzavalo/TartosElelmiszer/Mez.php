<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

class Mez extends TartosElelmiszer
{
    #[\Override] public static function name(): string
    {
        return 'Méz';
    }
}
