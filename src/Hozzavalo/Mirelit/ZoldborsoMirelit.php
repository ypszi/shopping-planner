<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Mirelit;

class ZoldborsoMirelit extends Mirelit
{
    #[\Override] public static function name(): string
    {
        return 'Zöldborsó mirelit';
    }
}
