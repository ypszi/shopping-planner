<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Liszt;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class BogreToKilogram extends MertekegysegValto
{
    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Liszt'
               && $hozzaadottHozzavalo->name() === 'Liszt'
               && $hozzavalo->measure() === Measure::BOGRE
               && $hozzaadottHozzavalo->measure() === Measure::KG;
    }

    protected function getMultiplier(): float
    {
        return 0.15;
    }
}
