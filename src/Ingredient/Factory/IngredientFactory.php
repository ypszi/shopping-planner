<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\Factory;

use PeterPecosz\ShoppingPlanner\Food\Exception\UnknownIngredientException;
use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
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
    public function forFood(string $foodName, array $ingredient): IngredientForFood
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

        return $this->createForFood(
            ingredientName: $ingredientName,
            portion:        (float)$portion,
            measure:        $measure,
            foodName:       $foodName
        );
    }

    /**
     * @throws UnknownIngredientException
     */
    private function createForFood(
        string $ingredientName,
        float $portion,
        Measure $measure,
        string $foodName,
    ): IngredientForFood {
        try {
            $ingredient = $this->create($ingredientName);

            return new IngredientForFood($ingredient->name(), $ingredient->category(), $portion, $measure, $ingredient->measurePreference());
        } catch (UnknownIngredientException $unknownIngredientException) {
            throw new UnknownIngredientException(sprintf('%s for food: "%s"', $unknownIngredientException->getMessage(), $foodName));
        }
    }

    /**
     * @throws UnknownIngredientException
     */
    public function createWithPortion(
        string $ingredientName,
        float $portion,
        Measure $measure
    ): Ingredient {
        $ingredient = $this->create($ingredientName);

        return new IngredientForFood($ingredient->name(), $ingredient->category(), $portion, $measure, $ingredient->measurePreference());
    }

    /**
     * @throws UnknownIngredientException
     */
    public function create(string $ingredientName): Ingredient
    {
        $ingredient = $this->ingredients[$ingredientName] ?? null;

        if (!isset($ingredient)) {
            throw new UnknownIngredientException(sprintf('Ingredient was not found: "%s"', $ingredientName));
        }

        if (is_string($ingredientRefName = $this->ingredients[$ingredientName] ?? null)) {
            $ingredientRef = $this->ingredients[$ingredientRefName] ?? null;

            if (!$ingredientRef) {
                throw new UnknownIngredientException(
                    sprintf('Ingredient reference not found: "%s"', $ingredientRefName)
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
                sprintf('Ingredient not found: "%s"', $ingredientName)
            );
        }

        if ($category !== $defaultIngredient['kategoria']) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient category mismatch for "%s": "%s" - "%s"',
                    $ingredientName,
                    $ingredient['kategoria'],
                    $defaultIngredient['kategoria']
                )
            );
        }

        if ($defaultIngredient && !in_array($defaultIngredient['kategoria'], array_keys($this->ingredientCategories))) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient category not found for "%s": "%s"',
                    $ingredientName,
                    $defaultIngredient['kategoria']
                )
            );
        }

        if ($measurePreference && !$ingredientMeasurePreference = Measure::tryFrom($measurePreference)) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient measurement not found for "%s": "%s"',
                    $ingredientName,
                    $measurePreference
                )
            );
        }

        return new Ingredient(
            $ingredientName,
            $category,
            $ingredientMeasurePreference ?? null
        );
    }
}
