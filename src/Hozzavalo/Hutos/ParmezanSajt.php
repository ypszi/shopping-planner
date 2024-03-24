<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hutos;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class ParmezanSajt extends Hutos
{
    public function __construct(float $mennyiseg, string $mertekegyseg = Mertekegyseg::DKG)
    {
        parent::__construct(static::name(), $mennyiseg, $mertekegyseg, static::kategoria());
    }

    #[\Override] public static function name(): string
    {
        return 'Parmezán sajt';
    }
}
