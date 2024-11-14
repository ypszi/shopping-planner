<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Cukor;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class MokkaskanalToKilogram extends MertekegysegValto
{
    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Cukor'
               && $hozzaadottHozzavalo->name() === 'Cukor'
               && $hozzavalo->measure() === Measure::MK
               && $hozzaadottHozzavalo->measure() === Measure::KG;
    }

    protected function getMultiplier(): float
    {
        return 0.002;
    }
}
