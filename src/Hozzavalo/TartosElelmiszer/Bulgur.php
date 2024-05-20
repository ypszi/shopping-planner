<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

class Bulgur extends TartosElelmiszer
{
    #[\Override] public static function name(): string
    {
        return 'Bulgur';
    }
}
