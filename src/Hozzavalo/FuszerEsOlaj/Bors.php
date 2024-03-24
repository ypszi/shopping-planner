<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

class Bors extends FuszerEsOlaj
{
    #[\Override] public static function name(): string
    {
        return 'Bors';
    }
}
