<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

class Szojaszosz extends TartosElelmiszer
{
    #[\Override] public static function name(): string
    {
        return 'Szójaszósz';
    }
}
