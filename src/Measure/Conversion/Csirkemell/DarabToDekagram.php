<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\Csirkemell;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class DarabToDekagram extends MeasureConversion
{
    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->name() === 'Csirkemell'
               && $addedIngredient->name() === 'Csirkemell'
               && $ingredient->measure() === Measure::DB
               && $addedIngredient->measure() === Measure::DKG;
    }

    protected function getMultiplier(): float
    {
        return 25.0;
    }
}
