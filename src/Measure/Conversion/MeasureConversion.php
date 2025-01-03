<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;

abstract class MeasureConversion
{
    public function convert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): IngredientForFood
    {
        return $addedIngredient->withPortion($ingredient->portion() * $this->getMultiplier());
    }

    abstract public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool;

    abstract protected function getMultiplier(): float;
}
