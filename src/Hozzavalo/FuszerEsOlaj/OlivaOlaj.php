<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class OlivaOlaj extends FuszerEsOlaj
{
    public function __construct(float $mennyiseg, string $mertekegyseg = Mertekegyseg::EK)
    {
        parent::__construct(static::name(), $mennyiseg, $mertekegyseg);
    }

    #[\Override] public static function name(): string
    {
        return 'Olíva olaj';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::DL;
    }
}
