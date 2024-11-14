<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\FinomLiszt;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValto;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class EvokanalToKilogram extends MertekegysegValto
{
    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        return $hozzavalo->name() === 'Finomliszt'
               && $hozzaadottHozzavalo->name() === 'Finomliszt'
               && $hozzavalo->measure() === Measure::EK
               && $hozzaadottHozzavalo->measure() === Measure::KG;
    }

    protected function getMultiplier(): float
    {
        return 0.02;
    }
}
