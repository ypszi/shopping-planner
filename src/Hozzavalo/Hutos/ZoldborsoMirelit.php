<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hutos;

class ZoldborsoMirelit extends Mirelit
{
    #[\Override] public static function name(): string
    {
        return 'Zöldborsó mirelit';
    }
}
