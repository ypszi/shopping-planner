<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

class Kemenyito extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Keményítő';
    }
}
