<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Supermarket;

use PeterPecosz\ShoppingPlanner\Food\Foods;
use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientRows;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientsByCategory;
use PeterPecosz\ShoppingPlanner\Measure\MeasureConverter;
use PeterPecosz\ShoppingPlanner\ShoppingList\ShoppingList;
use PeterPecosz\ShoppingPlanner\ShoppingList\ShoppingListByFood;

class Supermarket
{
    final public const DEFAULT = 'Auchan - Csömör';

    /**
     * @param string[] $categories
     */
    public function __construct(
        private readonly string $name,
        private readonly array $categories,
        private readonly CategoryMap $categoryMap,
        private readonly MeasureConverter $mertekegysegAtvalto,
        private readonly ?IngredientToCategoryMap $ingredientToCategoryMap = null
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string[]
     */
    public function toOrder(): array
    {
        return $this->categories;
    }

    public function toShoppingList(Foods $foods): ShoppingList
    {
        $ingredientsByCategory = new IngredientsByCategory();
        foreach ($foods as $food) {
            $ingredientsByCategory->addMultipleIngredients($food->ingredients());
        }

        return new ShoppingList($this->toOrder(), $this->createIngredientRows($ingredientsByCategory)->toArray());
    }

    public function toShoppingListByFood(Foods $foods): ShoppingListByFood
    {
        $rows = [];
        foreach ($foods as $food) {
            $ingredientsByCategory = new IngredientsByCategory();
            $ingredientsByCategory->addMultipleIngredients($food->ingredients());

            $rows[$food->name()] = $this->createIngredientRows($ingredientsByCategory)->toArray();
        }

        return new ShoppingListByFood($this->toOrder(), $rows);
    }

    private function createIngredientRows(IngredientsByCategory $ingredientsByCategory): IngredientRows
    {
        $ingredientRows = new IngredientRows($this, $this->mertekegysegAtvalto);

        foreach ($ingredientsByCategory as $ingredients) {
            /** @var Ingredient $ingredient */
            foreach ($ingredients as $ingredient) {
                $ingredient = $ingredient->withCategory(
                    $this->categoryMap->map($ingredient->category())
                );

                if ($this->ingredientToCategoryMap) {
                    $ingredient = $ingredient->withCategory(
                        $this->ingredientToCategoryMap->map($ingredient)
                    );
                }

                $ingredientRows->addIngredient($ingredient);
            }
        }

        return $ingredientRows->sort();
    }
}
