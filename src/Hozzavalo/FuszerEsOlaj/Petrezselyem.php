<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Petrezselyem extends FuszerEsOlaj
{
    public function __construct(float $mennyiseg, string $mertekegyseg = Mertekegyseg::TK)
    {
        parent::__construct(static::name(), $mennyiseg, $mertekegyseg);
    }

    #[\Override] public static function name(): string
    {
        return 'Petrezselyem';
    }
}
