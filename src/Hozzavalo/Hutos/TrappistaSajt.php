<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hutos;

class TrappistaSajt extends Hutos
{
    #[\Override] public static function name(): string
    {
        return 'Trappista sajt';
    }
}
