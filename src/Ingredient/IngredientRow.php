<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use PeterPecosz\ShoppingPlanner\Measure\Conversion\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\ShoppingPlanner\Measure\MeasureConverter;
use PeterPecosz\ShoppingPlanner\Supermarket\Supermarket;

class IngredientRow
{
    /** @var array<string, IngredientForFood> */
    private array $ingredientsByCategory;

    public function __construct(private readonly MeasureConverter $measureConverter)
    {
        $this->ingredientsByCategory = [];
    }

    /**
     * @return array<string, IngredientForFood>
     */
    public function getIngredientsByCategory(): array
    {
        return $this->ingredientsByCategory;
    }

    public function add(IngredientForFood $ingredient): self
    {
        $ingredient      = $this->convertToPreference($ingredient);
        $addedIngredient = $this->ingredientsByCategory[$ingredient->category()] ?? null;

        if (empty($addedIngredient)) {
            $this->ingredientsByCategory[$ingredient->category()] = $ingredient;

            return $this;
        }

        if ($this->canAddUsingConvert($ingredient, $addedIngredient)) {
            $newIngredient = $this->measureConverter->convert($ingredient, $addedIngredient);

            $this->ingredientsByCategory[$ingredient->category()] = $newIngredient->withPortion(
                $newIngredient->portion() + $addedIngredient->portion()
            );

            return $this;
        }

        if (
            $addedIngredient->name() === $ingredient->name()
            && $addedIngredient->measure() === $ingredient->measure()
        ) {
            $this->ingredientsByCategory[$ingredient->category()] = $addedIngredient->withPortion(
                $addedIngredient->portion() + $ingredient->portion()
            );
        }

        return $this;
    }

    public function canAdd(IngredientForFood $ingredient): bool
    {
        $addedIngredient = $this->ingredientsByCategory[$ingredient->category()] ?? null;

        if (empty($addedIngredient)) {
            return true;
        }

        if ($this->canAddUsingConvert($ingredient, $addedIngredient)) {
            return true;
        }

        return $addedIngredient->name() === $ingredient->name()
               && $addedIngredient->measure() === $ingredient->measure();
    }

    private function convertToPreference(IngredientForFood $ingredient): IngredientForFood
    {
        $newMeasure = $ingredient->measurePreference() ?? $ingredient->measure();

        if ($newMeasure === $ingredient->measure()) {
            return $ingredient;
        }

        try {
            $ingredient = $this->measureConverter->convert($ingredient, $ingredient->withMeasure($newMeasure));
        } catch (UnknownUnitOfMeasureException) {
        }

        return $ingredient;
    }

    /**
     * @return string[]
     */
    public function toArray(Supermarket $supermarket): array
    {
        $sor = [];
        foreach ($supermarket->toOrder() as $category) {
            $ingredient = $this->ingredientsByCategory[$category] ?? null;
            $sor[]      = $ingredient ? (string)$ingredient : '';
        }

        $notFoundCategories = array_diff(array_keys($this->ingredientsByCategory), $supermarket->toOrder());

        foreach ($notFoundCategories as $category) {
            $ingredient = $this->ingredientsByCategory[$category] ?? null;
            $sor[]      = $ingredient ? (string)$ingredient : '';
        }

        return $sor;
    }

    private function canAddUsingConvert(IngredientForFood $ingredient, IngredientForFood $addedIngredient): bool
    {
        if (
            $addedIngredient->name() === $ingredient->name()
            && $addedIngredient->measure() !== $ingredient->measure()
        ) {
            return $this->measureConverter->canConvert($ingredient, $addedIngredient);
        }

        return false;
    }

    /**
     * @param string[] $order
     */
    public function sort(array $order): self
    {
        uksort(
            $this->ingredientsByCategory,
            fn(string $ingredientCategory1, string $ingredientCategory2) => array_search($ingredientCategory1, $order) <=> array_search($ingredientCategory2, $order)
        );

        return $this;
    }
}
