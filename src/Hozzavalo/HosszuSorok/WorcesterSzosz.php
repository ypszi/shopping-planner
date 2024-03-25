<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

class WorcesterSzosz extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Worcester szósz';
    }
}
