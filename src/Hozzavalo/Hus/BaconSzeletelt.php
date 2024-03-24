<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BaconSzeletelt extends Hus
{
    public function __construct(float $mennyiseg, string $mertekegyseg = Mertekegyseg::G)
    {
        parent::__construct(static::name(), $mennyiseg, $mertekegyseg);
    }

    #[\Override] public static function name(): string
    {
        return 'Bacon (szeletelt)';
    }
}
