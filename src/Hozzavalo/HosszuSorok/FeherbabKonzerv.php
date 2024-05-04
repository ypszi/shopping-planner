<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

class FeherbabKonzerv extends Konzerv
{
    #[\Override] public static function name(): string
    {
        return 'Fehérbab konzerv';
    }
}
