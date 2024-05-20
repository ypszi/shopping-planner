<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Fuszer;

class CayenneBors extends Fuszer
{
    #[\Override] public static function name(): string
    {
        return 'Cayenne bors';
    }
}
