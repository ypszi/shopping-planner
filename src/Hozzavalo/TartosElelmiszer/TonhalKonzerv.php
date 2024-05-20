<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

class TonhalKonzerv extends Konzerv
{
    #[\Override] public static function name(): string
    {
        return 'Tonhal konzerv';
    }
}
