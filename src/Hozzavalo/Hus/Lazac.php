<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Lazac extends Hus
{
    #[\Override] public static function name(): string
    {
        return 'Lazac';
    }
}
