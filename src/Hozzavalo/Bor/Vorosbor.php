<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Bor;

class Vorosbor extends Bor
{
    #[\Override] public static function name(): string
    {
        return 'Vörösbor';
    }
}
