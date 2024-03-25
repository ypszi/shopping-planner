<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hutos;

class FetaSajt extends Hutos
{
    #[\Override] public static function name(): string
    {
        return 'Feta sajt';
    }
}
