<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

class PenneTeszta extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Penne tészta';
    }
}
