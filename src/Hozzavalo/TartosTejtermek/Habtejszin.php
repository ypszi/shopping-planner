<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek;

use Override;

class Habtejszin extends TartosTejtermek
{
    #[Override] public static function name(): string
    {
        return 'Habtejszín';
    }
}
