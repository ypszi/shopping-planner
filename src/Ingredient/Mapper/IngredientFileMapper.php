<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\Mapper;

use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

readonly class IngredientFileMapper
{
    public function __construct(
        private IngredientFactory $ingredientFactory,
        private string $ingredientStoragePath
    ) {
    }

    /**
     * @return array<string, IngredientForFood>
     */
    public function findAll(): array
    {
        $ingredients    = [];
        $rawIngredients = json_decode($this->readFile(), true) ?: [];

        foreach ($rawIngredients as $rawIngredient) {
            $ingredientName = $rawIngredient['name'];

            $ingredients[$ingredientName] = $this->ingredientFactory->createWithPortion(
                ingredientName: $ingredientName,
                portion:        $rawIngredient['portion'],
                measure:        Measure::from($rawIngredient['measure']),
            );
        }

        return $ingredients;
    }

    /**
     * @param IngredientForFood[] $ingredients
     *
     * @return IngredientForFood[]
     */
    public function save(array $ingredients): array
    {
        $rawIngredients = [];

        foreach ($ingredients as $ingredient) {
            $rawIngredients[$ingredient->name()] = [
                'name'    => $ingredient->name(),
                'portion' => $ingredient->portion(),
                'measure' => $ingredient->measure()?->value,
            ];
        }

        file_put_contents($this->ingredientStoragePath, json_encode(array_values($rawIngredients)));

        return $ingredients;
    }

    private function readFile(): string
    {
        if (!is_file($this->ingredientStoragePath)) {
            touch($this->ingredientStoragePath);
            file_put_contents($this->ingredientStoragePath, json_encode([]));
        }

        if (!is_readable($this->ingredientStoragePath)) {
            chmod($this->ingredientStoragePath, 0744);
        }

        return file_get_contents($this->ingredientStoragePath);
    }
}
