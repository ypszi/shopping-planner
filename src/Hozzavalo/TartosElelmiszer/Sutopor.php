<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

class Sutopor extends TartosElelmiszer
{
    #[\Override] public static function name(): string
    {
        return 'Sütőpor';
    }
}
