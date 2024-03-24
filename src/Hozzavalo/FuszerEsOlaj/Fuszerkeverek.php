<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

class Fuszerkeverek extends FuszerEsOlaj
{
    #[\Override] public static function name(): string
    {
        return 'Fűszerkeverék';
    }
}
