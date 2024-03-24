<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Baracklekvar extends HosszuSorok
{
    public function __construct(float $mennyiseg, string $mertekegyseg = Mertekegyseg::EK)
    {
        parent::__construct(static::name(), $mennyiseg, $mertekegyseg);
    }

    #[\Override] public static function name(): string
    {
        return 'Baracklekvár';
    }
}
