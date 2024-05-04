<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg;

class Csemegehagyma extends Zoldseg
{
    #[\Override] public static function name(): string
    {
        return 'Csemegehagyma';
    }
}
