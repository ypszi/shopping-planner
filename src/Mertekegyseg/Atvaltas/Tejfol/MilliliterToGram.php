<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tejfol;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class MilliliterToGram extends MertekegysegValto
{
    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Tejföl'
               && $hozzaadottHozzavalo->name() === 'Tejföl'
               && $hozzavalo->measure() === Measure::ML
               && $hozzaadottHozzavalo->measure() === Measure::G;
    }

    protected function getMultiplier(): float
    {
        return 0.1;
    }
}
