<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

class Sutopor extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Sütőpor';
    }
}
