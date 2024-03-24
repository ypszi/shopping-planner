<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Fokhagyma extends Zoldseg
{
    public function __construct(float $mennyiseg, string $mertekegyseg = Mertekegyseg::GEREZD)
    {
        parent::__construct(static::name(), $mennyiseg, $mertekegyseg);
    }

    #[\Override] public static function name(): string
    {
        return 'Fokhagyma';
    }
}
