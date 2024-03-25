<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hutos;

class NaturJoghurt extends Hutos
{
    #[\Override] public static function name(): string
    {
        return 'Natúr joghurt';
    }
}
