<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

class Mustar extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Mustár';
    }
}
