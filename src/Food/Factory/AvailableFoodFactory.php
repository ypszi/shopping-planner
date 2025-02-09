<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Shopping\Input\FoodFilterInput;
use PeterPecosz\ShoppingPlanner\Shopping\Input\Operator;
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
    public function listAvailableFoods(FoodFilterInput $filterInput): array
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

        return $this->sortFoods($this->filterFoods($filterInput, $availableFoods));
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

    /**
     * @param Food[] $foods
     *
     * @return Food[]
     */
    private function filterFoods(FoodFilterInput $filterInput, array $foods): array
    {
        if ($filterInput->tags() === null) {
            return $foods;
        }

        if ($filterInput->operator() === Operator::AND) {
            return array_filter(
                $foods,
                fn(Food $food) => array_intersect($filterInput->tags(), $food->tags()) === $filterInput->tags()
            );
        }

        $filteredFoods = [];
        foreach ($filterInput->tags() as $tag) {
            $filteredFoods += array_filter(
                $foods,
                fn(Food $food) => in_array($tag, $food->tags(), true)
            );
        }

        return array_values($filteredFoods);
    }

    /**
     * @param Food[] $foods
     *
     * @return Food[]
     */
    private function sortFoods(array $foods): array
    {
        usort($foods, function (Food $food1, Food $food2) {
            return strnatcmp($food1->name(), $food2->name());
        });

        return array_values($foods);
    }
}
