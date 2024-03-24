<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Kakaopor extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Kakaópor';
    }
}
