<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

class Fozotejszin extends HutosUtan
{
    #[\Override] public static function name(): string
    {
        return 'Főzőtejszín';
    }
}
