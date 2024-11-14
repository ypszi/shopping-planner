<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class EvoKanalToMokkasKanal extends MertekegysegValto
{
    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->measure() === Measure::EK
               && $hozzaadottHozzavalo->measure() === Measure::MK;
    }

    protected function getMultiplier(): float
    {
        return 15.0 / 2.0;
    }
}
