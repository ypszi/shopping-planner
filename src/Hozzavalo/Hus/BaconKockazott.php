<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

class BaconKockazott extends Hus
{
    #[\Override] public static function name(): string
    {
        return 'Bacon (kockázott)';
    }
}
