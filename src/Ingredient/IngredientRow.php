<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\MertekegysegAtvalto;
use PeterPecosz\ShoppingPlanner\Supermarket\Supermarket;

class IngredientRow
{
    private MertekegysegAtvalto $mertekegysegAtvalto;

    /** @var array<string, Ingredient> */
    private array $ingredientsByCategory;

    public function __construct()
    {
        $this->mertekegysegAtvalto   = new MertekegysegAtvalto();
        $this->ingredientsByCategory = [];
    }

    /**
     * @return array<string, Ingredient>
     */
    public function getIngredientsByCategory(): array
    {
        return $this->ingredientsByCategory;
    }

    public function add(Ingredient $ingredient): self
    {
        $ingredient      = $this->convertToPreference($ingredient);
        $addedIngredient = $this->ingredientsByCategory[$ingredient->category()] ?? null;

        if (empty($addedIngredient)) {
            $this->ingredientsByCategory[$ingredient->category()] = $ingredient;

            return $this;
        }

        if ($this->canAddUsingConvert($ingredient, $addedIngredient)) {
            $newPortion = $this->mertekegysegAtvalto->valt(
                $ingredient,
                $addedIngredient
            );

            $this->ingredientsByCategory[$ingredient->category()] = $addedIngredient->withPortion(
                $addedIngredient->portion() + $newPortion
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

    public function canAdd(Ingredient $ingredient): bool
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

    private function convertToPreference(Ingredient $ingredient): Ingredient
    {
        $newMertekegyseg = $ingredient->measurePreference() ?? $ingredient->measure();

        if ($newMertekegyseg === $ingredient->measure()) {
            return $ingredient;
        }

        try {
            $newMennyiseg = $this->mertekegysegAtvalto->valt(
                $ingredient,
                $ingredient->withMeasure($newMertekegyseg)
            );
        } catch (UnknownUnitOfMeasureException) {
            $newMennyiseg    = $ingredient->portion();
            $newMertekegyseg = $ingredient->measure();
        }

        return $ingredient
            ->withPortion($newMennyiseg)
            ->withMeasure($newMertekegyseg);
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

    private function canAddUsingConvert(Ingredient $ingredient, Ingredient $addedIngredient): bool
    {
        if (
            $addedIngredient->name() === $ingredient->name()
            && $addedIngredient->measure() !== $ingredient->measure()
        ) {
            return $this->mertekegysegAtvalto->canValt(
                $ingredient,
                $addedIngredient
            );
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