<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

class VorosborSzaraz extends Vorosbor
{
    #[\Override] public static function name(): string
    {
        return parent::name() . ' (száraz)';
    }
}
