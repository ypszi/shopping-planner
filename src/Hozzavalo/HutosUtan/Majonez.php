<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

class Majonez extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Majonéz';
    }
}
