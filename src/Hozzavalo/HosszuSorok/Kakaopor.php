<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

class Kakaopor extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Kakaópor';
    }
}
