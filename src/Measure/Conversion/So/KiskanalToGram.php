<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\So;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class KiskanalToGram extends MeasureConversion
{
    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->name() === 'Só'
               && $addedIngredient->name() === 'Só'
               && $ingredient->measure() === Measure::KK
               && $addedIngredient->measure() === Measure::G;
    }

    protected function getMultiplier(): float
    {
        return 2.0;
    }
}
