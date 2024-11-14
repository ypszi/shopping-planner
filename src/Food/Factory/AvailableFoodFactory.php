<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientFactory;
use Symfony\Component\Yaml\Yaml;

readonly class AvailableFoodFactory
{
    /** @var array<string, array<string, mixed>> */
    private array $foods;

    public function __construct(
        private FoodFactory $foodFactory,
        private IngredientFactory $ingredientFactory,
        string $foodsPath
    ) {
        $this->foods = Yaml::parseFile($foodsPath);
    }

    /**
     * @return Food[]
     */
    public function listAvailableFoods(): array
    {
        $availableFoods = [];

        foreach ($this->foods as $foodName => $food) {
            $ingredients = [];

            foreach ($food['ingredients'] as $ingredient) {
                if (isset($ingredient['ref'])) {
                    $refFoodName    = $ingredient['ref'];
                    $additionalFood = $this->createReferenceFood(refFoodName: $refFoodName);
                    $ingredients    = array_merge($ingredients, $additionalFood->ingredients());

                    continue;
                }

                $ingredients[] = $this->ingredientFactory->forFood(foodName: $foodName, ingredient: $ingredient);
            }

            $availableFoods[] = $this->foodFactory->createFood(foodName: $foodName, ingredients: $ingredients);
        }

        return $availableFoods;
    }

    private function createReferenceFood(string $refFoodName): Food
    {
        $ingredients = [];
        foreach ($this->foods[$refFoodName]['ingredients'] as $refIngredient) {
            $ingredients[] = $this->ingredientFactory->forFood(
                foodName:   $refFoodName,
                ingredient: $refIngredient
            );
        }

        return $this->foodFactory->createFood(
            foodName:    $refFoodName,
            ingredients: $ingredients
        );
    }
}
