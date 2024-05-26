<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Bor;

class FeherborSzaraz extends Feherbor
{
    public static function name(): string
    {
        return parent::name() . ' (száraz)';
    }
}
