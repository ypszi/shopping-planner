<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek;

class Habtejszin extends TartosTejtermek
{
    #[\Override] public static function name(): string
    {
        return 'Habtejszín';
    }
}
