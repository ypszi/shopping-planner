<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\Vorosbab;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class KonzervToGram extends MeasureConversion
{
    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->name() === 'Vörösbab (konzerv)'
               && $addedIngredient->name() === 'Vörösbab (konzerv)'
               && $ingredient->measure() === Measure::KONZERV
               && $addedIngredient->measure() === Measure::G;
    }

    protected function getMultiplier(): float
    {
        return 250.0;
    }
}
