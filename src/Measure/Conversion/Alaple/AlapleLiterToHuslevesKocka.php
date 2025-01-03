<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion\Alaple;

use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\MeasureConversion;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class AlapleLiterToHuslevesKocka extends MeasureConversion
{
    public function __construct(
        private readonly IngredientFactory $ingredientFactory,
    ) {
    }

    public function canConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        return $ingredient->name() === 'Alaplé'
               && $addedIngredient->name() === 'Alaplé'
               && $ingredient->measure() === Measure::L;
    }

    public function convert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): IngredientForFood
    {
        $newIngredient = parent::convert($ingredient, $addedIngredient);

        return $this->ingredientFactory->createWithPortion(
            ingredientName: 'Húsleves kocka',
            portion:        $newIngredient->portion(),
            measure:        Measure::DB
        );
    }

    protected function getMultiplier(): float
    {
        return 2;
    }
}

