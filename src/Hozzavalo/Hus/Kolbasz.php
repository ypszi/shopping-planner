<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

class Kolbasz extends Hus
{
    #[\Override] public static function name(): string
    {
        return 'Kolbász';
    }
}
