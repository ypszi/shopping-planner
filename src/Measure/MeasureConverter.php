<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversionCollection;

readonly class MeasureConverter
{
    public function __construct(private MeasureConversionCollection $measureConversionCollection)
    {
    }

    public function canConvert(IngredientForFood $hozzavalo, IngredientForFood $hozzaadottHozzavalo): bool
    {
        try {
            $this->measureConversionCollection->get($hozzavalo, $hozzaadottHozzavalo);
        } catch (UnknownUnitOfMeasureException) {
            return false;
        }

        return true;
    }

    public function convert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): IngredientForFood
    {
        return $this->measureConversionCollection->get($ingredient, $addedIngredient)->convert($ingredient, $addedIngredient);
    }
}
