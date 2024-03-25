<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

class Baracklekvar extends HosszuSorok
{
    #[\Override] public static function name(): string
    {
        return 'Baracklekvár';
    }
}
