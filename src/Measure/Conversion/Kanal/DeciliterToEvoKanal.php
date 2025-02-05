<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\Kanal;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class DeciliterToEvoKanal extends MeasureConversion
{
    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->measure() === Measure::DL
               && $addedIngredient->measure() === Measure::EK;
    }

    /**
     * 1 DL = ~6.67 EK
     */
    protected function getMultiplier(): float
    {
        return 1 / 0.15;
    }
}
