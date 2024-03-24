<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Habtejszin extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Habtejszín';
    }
}
