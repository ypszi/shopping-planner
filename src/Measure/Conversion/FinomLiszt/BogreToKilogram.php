<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\FinomLiszt;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class BogreToKilogram extends MeasureConversion
{
    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->name() === 'Finomliszt'
               && $addedIngredient->name() === 'Finomliszt'
               && $ingredient->measure() === Measure::BOGRE
               && $addedIngredient->measure() === Measure::KG;
    }

    protected function getMultiplier(): float
    {
        return 0.15;
    }
}
