<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Fuszer;

class GulyasKrem extends Fuszer
{
    #[\Override] public static function name(): string
    {
        return 'Gulyás krém';
    }
}