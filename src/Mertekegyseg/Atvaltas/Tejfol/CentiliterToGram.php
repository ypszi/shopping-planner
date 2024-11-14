<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Tejfol;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class CentiliterToGram extends MertekegysegValto
{
    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Tejföl'
               && $hozzaadottHozzavalo->name() === 'Tejföl'
               && $hozzavalo->measure() === Measure::CL
               && $hozzaadottHozzavalo->measure() === Measure::G;
    }

    protected function getMultiplier(): float
    {
        return 1.0;
    }
}
