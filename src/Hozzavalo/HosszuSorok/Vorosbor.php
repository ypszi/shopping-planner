<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

class Vorosbor extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Vörösbor';
    }
}
