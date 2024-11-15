<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\Factory;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use Symfony\Component\Yaml\Yaml;

readonly class AvailableIngredientFactory
{
    /** @var array<string, array<string, mixed>> */
    private array $ingredients;

    public function __construct(
        private IngredientFactory $ingredientFactory,
        string $ingredientsPath
    ) {
        $this->ingredients = Yaml::parseFile($ingredientsPath);
    }

    /**
     * @return Ingredient[]
     */
    public function listAvailableIngredients(): array
    {
        $availableIngredients = [];
        foreach ($this->ingredients as $ingredientName => $ingredient) {
            $availableIngredients[] = $this->ingredientFactory->create($ingredientName);
        }

        return $availableIngredients;
    }
}
