<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

class CsuszaTeszta extends TartosElelmiszer
{
    #[\Override] public static function name(): string
    {
        return 'Csusza tészta';
    }
}