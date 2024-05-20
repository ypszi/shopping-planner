<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Felvagott;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Felvagott extends Hozzavalo
{
    public function __construct(float $mennyiseg, string $mertekegyseg)
    {
        parent::__construct($mennyiseg, $mertekegyseg, HozzavaloKategoria::FELVAGOTT);
    }

    #[\Override] public static function name(): string
    {
        return 'Felvágott';
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::DKG;
    }
}
