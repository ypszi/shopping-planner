<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Kanal;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class MokkasKanalToEvoKanal extends MertekegysegValto
{
    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->measure() === Measure::MK
               && $hozzaadottHozzavalo->measure() === Measure::EK;
    }

    protected function getMultiplier(): float
    {
        return 2.0 / 15.0;
    }
}
