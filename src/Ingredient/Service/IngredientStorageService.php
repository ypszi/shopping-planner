<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\Service;

use PeterPecosz\ShoppingPlanner\Ingredient\Factory\AvailableIngredientFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Ingredient\Mapper\IngredientFileMapper;

readonly class IngredientStorageService
{
    public function __construct(
        private AvailableIngredientFactory $availableIngredientFactory,
        private IngredientFileMapper $ingredientFileMapper
    ) {
    }

    /**
     * @return Ingredient[]
     */
    public function getAvailableIngredients(): array
    {
        return $this->availableIngredientFactory->listAvailableIngredients();
    }

    /**
     * @return array<string, IngredientForFood[]>
     */
    public function getIngredientStorage(): array
    {
        $availableIngredients = $this->getAvailableIngredients();
        $ingredientForFoods   = $this->ingredientFileMapper->findAll();

        $storage = [];

        foreach ($availableIngredients as $availableIngredient) {
            $ingredientName    = $availableIngredient->name();
            $ingredientForFood = $ingredientForFoods[$ingredientName] ?? null;

            $storage[$availableIngredient->category()][$ingredientName] = new IngredientForFood(
                name:              $ingredientName,
                category:          $availableIngredient->category(),
                portion:           $ingredientForFood?->portion() ?? 0,
                measure:           $ingredientForFood?->measure(),
                measurePreference: $availableIngredient->measurePreference(),
                reference:         $availableIngredient->reference()
            );
        }

        return array_map('array_values', $storage);
    }

    /**
     * @param IngredientForFood[] $ingredients
     *
     * @return IngredientForFood[]
     */
    public function saveIngredientStorage(array $ingredients): array
    {
        return $this->ingredientFileMapper->save($ingredients);
    }
}
