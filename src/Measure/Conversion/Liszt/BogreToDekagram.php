<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\Liszt;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class BogreToDekagram extends MeasureConversion
{
    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->name() === 'Liszt'
               && $addedIngredient->name() === 'Liszt'
               && $ingredient->measure() === Measure::BOGRE
               && $addedIngredient->measure() === Measure::DKG;
    }

    protected function getMultiplier(): float
    {
        return 15.0;
    }
}
