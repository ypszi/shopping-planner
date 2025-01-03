<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\Porcukor;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class EvokanalToKilogram extends MeasureConversion
{
    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->name() === 'Porcukor'
               && $addedIngredient->name() === 'Porcukor'
               && $ingredient->measure() === Measure::EK
               && $addedIngredient->measure() === Measure::KG;
    }

    protected function getMultiplier(): float
    {
        return 0.02;
    }
}
