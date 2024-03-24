<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class HuslevesKocka extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Húsleves kocka';
    }
}
