<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg;

class KaliforniaiPaprikaSarga extends KaliforniaiPaprika
{
    public static function name(): string
    {
        return parent::name() . ' (sárga)';
    }
}
