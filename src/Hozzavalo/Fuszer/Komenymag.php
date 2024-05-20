<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Fuszer;

class Komenymag extends Fuszer
{
    #[\Override] public static function name(): string
    {
        return 'Köménymag';
    }
}
