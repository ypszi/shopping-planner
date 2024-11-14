<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use PeterPecosz\ShoppingPlanner\Food\Exception\UnknownIngredientException;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use Symfony\Component\Yaml\Yaml;

readonly class IngredientFactory
{
    /** @var array<string, array<string, string>> */
    private array $ingredients;

    /** @var array<string, array<string, string>> */
    private array $ingredientCategories;

    public function __construct(
        string $ingredientsPath,
        string $ingredientCategoriesPath
    ) {
        $this->ingredients          = Yaml::parseFile($ingredientsPath);
        $this->ingredientCategories = Yaml::parseFile($ingredientCategoriesPath);
    }

    /**
     * @param array<string, mixed> $ingredient
     */
    public function forFood(string $foodName, array $ingredient): Ingredient
    {
        $ingredientName = $ingredient['name'];

        [$portion, $rawMertekegyseg] = explode(' ', $ingredient['mennyiseg']);

        if (!$measure = Measure::tryFrom($rawMertekegyseg)) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient measurement not found for "%s": "%s" for food: "%s"',
                    $ingredientName,
                    $rawMertekegyseg,
                    $foodName
                )
            );
        }

        return $this->create(
            ingredientName: $ingredientName,
            portion:        (float)$portion,
            measure:        $measure,
            foodName:       $foodName
        );
    }

    private function create(
        string $ingredientName,
        float $portion,
        Measure $measure,
        string $foodName,
    ): Ingredient {
        $ingredient = $this->ingredients[$ingredientName] ?? null;

        if (!isset($ingredient)) {
            throw new UnknownIngredientException(sprintf('Ingredient was not found: "%s"', $ingredientName));
        }

        if (is_string($ingredientRefName = $this->ingredients[$ingredientName] ?? null)) {
            $ingredientRef = $this->ingredients[$ingredientRefName] ?? null;

            if (!$ingredientRef) {
                throw new UnknownIngredientException(
                    sprintf('Ingredient reference not found: "%s" for food: "%s"', $ingredientRefName, $foodName)
                );
            }

            $ingredientName = $ingredientRefName;
            $ingredient     = $ingredientRef;
        }

        $defaultIngredient = $this->ingredients[$ingredientName] ?? [];
        $category          = $ingredient['kategoria'] ?? $defaultIngredient['kategoria'] ?? null;
        $measurePreference = $ingredient['mertekegysegPreference']
                             ?? $defaultIngredient['mertekegysegPreference']
                                ?? $this->ingredientCategories[$category]['mertekegysegPreference']
                                   ?? null;

        if (!$category) {
            throw new UnknownIngredientException(
                sprintf('Ingredient not found: "%s" for food: "%s"', $ingredientName, $foodName)
            );
        }

        if ($category !== $defaultIngredient['kategoria']) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient category mismatch for "%s": "%s" - "%s" for food: "%s"',
                    $ingredientName,
                    $ingredient['kategoria'],
                    $defaultIngredient['kategoria'],
                    $foodName
                )
            );
        }

        if ($defaultIngredient && !in_array($defaultIngredient['kategoria'], array_keys($this->ingredientCategories))) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient category not found for "%s": "%s" for food: "%s"',
                    $ingredientName,
                    $defaultIngredient['kategoria'],
                    $foodName
                )
            );
        }

        if ($measurePreference && !$ingredientMeasurePreference = Measure::tryFrom($measurePreference)) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient measurement not found for "%s": "%s" for food: "%s"',
                    $ingredientName,
                    $measurePreference,
                    $foodName
                )
            );
        }

        return new Ingredient(
            $ingredientName,
            $portion,
            $measure,
            $category,
            $ingredientMeasurePreference ?? null
        );
    }
}
