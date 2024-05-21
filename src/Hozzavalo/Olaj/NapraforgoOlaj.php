<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Olaj;

use Override;

class NapraforgoOlaj extends Olaj
{
    #[Override] public static function name(): string
    {
        return 'Napraforgó olaj';
    }
}
