<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\So;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class EvokanalToGram extends MertekegysegValto
{
    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Só'
               && $hozzaadottHozzavalo->name() === 'Só'
               && $hozzavalo->measure() === Measure::EK
               && $hozzaadottHozzavalo->measure() === Measure::G;
    }

    protected function getMultiplier(): float
    {
        return 20.0;
    }
}
