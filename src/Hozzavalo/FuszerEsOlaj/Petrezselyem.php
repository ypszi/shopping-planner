<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

class Petrezselyem extends FuszerEsOlaj
{
    #[\Override] public static function name(): string
    {
        return 'Petrezselyem';
    }
}
