<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Fuszer;

class Tarkony extends Fuszer
{
    #[\Override] public static function name(): string
    {
        return 'Tárkony';
    }
}
