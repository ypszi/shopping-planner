<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\Tomeg;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class KilogramToDekagram extends MeasureConversion
{
    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->measure() === Measure::KG
               && $addedIngredient->measure() === Measure::DKG;
    }

    protected function getMultiplier(): float
    {
        return 100.0;
    }
}
