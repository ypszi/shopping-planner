<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

class Habtejszin extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Habtejszín';
    }
}
