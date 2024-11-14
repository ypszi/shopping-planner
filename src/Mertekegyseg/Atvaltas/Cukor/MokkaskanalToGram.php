<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class MokkaskanalToGram extends MertekegysegValto
{
    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Cukor'
               && $hozzaadottHozzavalo->name() === 'Cukor'
               && $hozzavalo->measure() === Measure::MK
               && $hozzaadottHozzavalo->measure() === Measure::G;
    }

    protected function getMultiplier(): float
    {
        return 2.0;
    }
}
