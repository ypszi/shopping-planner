<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek;

class FetaSajt extends Tejtermek
{
    #[\Override] public static function name(): string
    {
        return 'Feta sajt';
    }
}