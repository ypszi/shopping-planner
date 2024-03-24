<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Szojaszosz extends HosszuSorok
{
    public function __construct(float $mennyiseg, string $mertekegyseg = Mertekegyseg::ML)
    {
        parent::__construct(static::name(), $mennyiseg, $mertekegyseg, static::kategoria());
    }

    #[\Override] public static function name(): string
    {
        return 'Szójaszósz';
    }
}
