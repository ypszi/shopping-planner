<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use PeterPecosz\ShoppingPlanner\Measure\MeasureConverter;
use PeterPecosz\ShoppingPlanner\Supermarket\Supermarket;

class IngredientRows
{
    /** @var IngredientRow[] */
    private array $ingredientRows;

    public function __construct(
        private readonly Supermarket $supermarket,
        private readonly MeasureConverter $mertekegysegAtvalto
    ) {
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
        $ingredientRows    = new self($this->supermarket, $this->mertekegysegAtvalto);

        foreach ($sortedIngredients as $ingredients) {
            foreach ($ingredients as $ingredient) {
                $ingredientRows->addIngredient($ingredient);
            }
        }

        $this->ingredientRows = $ingredientRows->ingredientRows;

        return $this;
    }

    public function addIngredient(IngredientForFood $ingredient): void
    {
        foreach ($this->ingredientRows as $ingredientRow) {
            if ($ingredientRow->canAdd($ingredient)) {
                $ingredientRow->add($ingredient);
                $ingredientRow->sort($this->supermarket->toOrder());

                return;
            }
        }

        $nextIngredientRow = new IngredientRow($this->mertekegysegAtvalto);
        $nextIngredientRow->add($ingredient);
        $nextIngredientRow->sort($this->supermarket->toOrder());

        $this->add($nextIngredientRow);
    }

    /**
     * @return array<string, IngredientForFood[]>
     */
    private function sortIngredients(): array
    {
        return $this->sortByName($this->sortByMertekegyseg($this->groupHozzavalokByKategoria()));
    }

    /**
     * @return array<string, IngredientForFood[]>
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
     * @param array<string, IngredientForFood[]> $ingredientsByCategory
     *
     * @return array<string, IngredientForFood[]>
     */
    private function sortByMertekegyseg(array $ingredientsByCategory): array
    {
        foreach ($ingredientsByCategory as &$ingredients) {
            usort(
                $ingredients,
                function (IngredientForFood $ingredient1, IngredientForFood $ingredient2) {
                    return strnatcmp($ingredient1->measure()?->value ?? '', $ingredient2->measure()?->value ?? '');
                }
            );
        }

        return $ingredientsByCategory;
    }

    /**
     * @param array<string, IngredientForFood[]> $ingredientsByCategory
     *
     * @return array<string, IngredientForFood[]>
     */
    private function sortByName(array $ingredientsByCategory): array
    {
        foreach ($ingredientsByCategory as &$ingredients) {
            usort(
                $ingredients,
                function (IngredientForFood $ingredient1, IngredientForFood $ingredient2) {
                    return strnatcmp($ingredient1->name(), $ingredient2->name());
                }
            );
        }

        return $ingredientsByCategory;
    }
}
