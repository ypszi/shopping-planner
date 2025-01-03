<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\Cukor;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class MokkaskanalToKilogram extends MeasureConversion
{
    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->name() === 'Cukor'
               && $addedIngredient->name() === 'Cukor'
               && $ingredient->measure() === Measure::MK
               && $addedIngredient->measure() === Measure::KG;
    }

    protected function getMultiplier(): float
    {
        return 0.002;
    }
}
