<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Fuszer;

class Zoldfuszer extends Fuszer
{
    #[\Override] public static function name(): string
    {
        return 'Zöldfűszer';
    }
}
