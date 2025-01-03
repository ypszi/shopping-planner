<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\Csirkemell;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class KilogramToDarab extends MeasureConversion
{
    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->name() === 'Csirkemell'
               && $addedIngredient->name() === 'Csirkemell'
               && $ingredient->measure() === Measure::KG
               && $addedIngredient->measure() === Measure::DB;
    }

    protected function getMultiplier(): float
    {
        return 4;
    }
}
