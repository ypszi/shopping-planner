<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\Factory;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\Mapper\IngredientFileMapper;

readonly class AvailableIngredientFactory
{
    public function __construct(
        private IngredientFileMapper $ingredientFileMapper
    ) {
    }

    /**
     * @return Ingredient[]
     */
    public function listAvailableIngredients(): array
    {
        return $this->ingredientFileMapper->findAll();
    }
}
