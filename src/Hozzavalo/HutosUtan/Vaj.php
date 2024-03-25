<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

class Vaj extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Vaj';
    }
}
