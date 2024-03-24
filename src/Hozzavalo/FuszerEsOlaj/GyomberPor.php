<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

class GyomberPor extends FuszerEsOlaj
{
    #[\Override] public static function name(): string
    {
        return 'Gyömbér por';
    }
}
