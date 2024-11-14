<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Csirkemell;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class DekagramToDarab extends MertekegysegValto
{
    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Csirkemell'
               && $hozzaadottHozzavalo->name() === 'Csirkemell'
               && $hozzavalo->measure() === Measure::DKG
               && $hozzaadottHozzavalo->measure() === Measure::DB;
    }

    protected function getMultiplier(): float
    {
        return 0.04;
    }
}
