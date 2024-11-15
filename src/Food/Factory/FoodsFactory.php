<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\Foods;
use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use Symfony\Component\Yaml\Yaml;

readonly class FoodsFactory
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
     * @param array<string, int> $foodPortionsByFoodName
     */
    public function create(array $foodPortionsByFoodName): Foods
    {
        $foods = new Foods();

        foreach ($foodPortionsByFoodName as $foodName => $portion) {
            $food = $this->foods[$foodName] ?? null;

            if (!isset($food)) {
                continue;
            }

            $ingredients = [];

            foreach ($food['ingredients'] as $ingredient) {
                if (isset($ingredient['ref'])) {
                    $refFoodName    = $ingredient['ref'];
                    $additionalFood = $this->createReferenceFood($refFoodName, $portion);
                    $ingredients     = array_merge($ingredients, $additionalFood->ingredients());

                    continue;
                }

                $ingredients[] = $this->ingredientFactory->forFood(
                    foodName:   $foodName,
                    ingredient: $ingredient
                );
            }

            $etel = $this->foodFactory->createFood($foodName, $ingredients, $portion);

            $foods->add($etel);
        }

        return $foods;
    }

    private function createReferenceFood(string $refFoodName, ?int $portion = null): Food
    {
        $ingredients = [];
        foreach ($this->foods[$refFoodName]['ingredients'] as $ingredient) {
            $ingredients[] = $this->ingredientFactory->forFood(
                foodName:   $refFoodName,
                ingredient: $ingredient
            );
        }

        return $this->foodFactory->createFood(
            foodName:    $refFoodName,
            ingredients: $ingredients,
            portion:     $portion
        );
    }
}
