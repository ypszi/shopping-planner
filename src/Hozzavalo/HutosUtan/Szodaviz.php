<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

class Szodaviz extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Szodavíz';
    }
}
