<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use PeterPecosz\ShoppingPlanner\Supermarket\Supermarket;

class IngredientRows
{
    private Supermarket $supermarket;

    /** @var IngredientRow[] */
    private array $ingredientRows;

    public function __construct(Supermarket $supermarket)
    {
        $this->supermarket    = $supermarket;
        $this->ingredientRows = [];
    }

    public function add(IngredientRow $ingredientRow): self
    {
        $this->ingredientRows[] = $ingredientRow;

        return $this;
    }

    /**
     * @return string[][]
     */
    public function toArray(): array
    {
        return array_map(fn(IngredientRow $ingredientRow) => $ingredientRow->toArray($this->supermarket), $this->ingredientRows);
    }

    public function sort(): self
    {
        $sortedIngredients = $this->sortIngredients();
        $ingredientRows    = new self($this->supermarket);

        foreach ($sortedIngredients as $ingredients) {
            foreach ($ingredients as $ingredient) {
                $ingredientRows->addIngredient($ingredient);
            }
        }

        $this->ingredientRows = $ingredientRows->ingredientRows;

        return $this;
    }

    public function addIngredient(Ingredient $ingredient): void
    {
        foreach ($this->ingredientRows as $ingredientRow) {
            if ($ingredientRow->canAdd($ingredient)) {
                $ingredientRow->add($ingredient);
                $ingredientRow->sort($this->supermarket->toOrder());

                return;
            }
        }

        $nextIngredientRow = new IngredientRow();
        $nextIngredientRow->add($ingredient);
        $nextIngredientRow->sort($this->supermarket->toOrder());

        $this->add($nextIngredientRow);
    }

    /**
     * @return array<string, Ingredient[]>
     */
    private function sortIngredients(): array
    {
        return $this->sortByName($this->sortByMertekegyseg($this->groupHozzavalokByKategoria()));
    }

    /**
     * @return array<string, Ingredient[]>
     */
    private function groupHozzavalokByKategoria(): array
    {
        $ingredientsByCategory = [];
        foreach ($this->ingredientRows as $ingredientRow) {
            foreach ($ingredientRow->getIngredientsByCategory() as $category => $ingredient) {
                $ingredientsByCategory[$category][] = $ingredient;
            }
        }

        return $ingredientsByCategory;
    }

    /**
     * @param array<string, Ingredient[]> $ingredientsByCategory
     *
     * @return array<string, Ingredient[]>
     */
    private function sortByMertekegyseg(array $ingredientsByCategory): array
    {
        foreach ($ingredientsByCategory as &$ingredients) {
            usort($ingredients, function (Ingredient $ingredient1, Ingredient $ingredient2) {
                return strnatcmp($ingredient1->measure()->value, $ingredient2->measure()->value);
            });
        }

        return $ingredientsByCategory;
    }

    /**
     * @param array<string, Ingredient[]> $ingredientsByCategory
     *
     * @return array<string, Ingredient[]>
     */
    private function sortByName(array $ingredientsByCategory): array
    {
        foreach ($ingredientsByCategory as &$ingredients) {
            usort($ingredients, function (Ingredient $ingredient1, Ingredient $ingredient2) {
                return strnatcmp($ingredient1->name(), $ingredient2->name());
            });
        }

        return $ingredientsByCategory;
    }
}
