<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Olaj;

class NapraforgoOlaj extends Olaj
{
    #[\Override] public static function name(): string
    {
        return 'Napraforgó olaj';
    }
}
