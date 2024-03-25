<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

class Ketchup extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Ketchup';
    }
}
