<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Fuszer;

class Fuszerkomeny extends Komenymag
{
    #[\Override] public static function name(): string
    {
        return 'Fűszerkömény';
    }
}
