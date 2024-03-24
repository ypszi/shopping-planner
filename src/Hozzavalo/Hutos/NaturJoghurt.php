<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hutos;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class NaturJoghurt extends Hutos
{
    #[\Override] public static function name(): string
    {
        return 'Natúr joghurt';
    }
}
