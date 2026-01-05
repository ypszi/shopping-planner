<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\Factory;

use PeterPecosz\ShoppingPlanner\Ingredient\Exception\UnknownIngredientException;
use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
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

        [$portion, $rawPortion] = explode(' ', $ingredient['portion']);

        if (!$measure = Measure::tryFrom($rawPortion)) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient measurement not found for "%s": "%s" for food: "%s"',
                    $ingredientName,
                    $rawPortion,
                    $foodName
                )
            );
        }

        return $this->createForFood(
            ingredientName: $ingredientName,
            portion       : (float)$portion,
            measure       : $measure,
            foodName      : $foodName
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

            return new IngredientForFood(
                $ingredient->name(),
                $ingredient->category(),
                $portion,
                $measure,
                $ingredient->measurePreference(),
                $ingredient->reference()
            );
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
    ): IngredientForFood {
        $ingredient = $this->create($ingredientName);

        return new IngredientForFood(
            $ingredient->name(),
            $ingredient->category(),
            $portion,
            $measure,
            $ingredient->measurePreference(),
            $ingredient->reference()
        );
    }

    /**
     * @throws UnknownIngredientException
     */
    public function create(string $ingredientName): Ingredient
    {
        $rawIngredient = $this->ingredients[$ingredientName] ?? null;

        if (!isset($rawIngredient)) {
            throw new UnknownIngredientException(sprintf('Ingredient was not found: "%s"', $ingredientName));
        }

        if (is_string($ingredientRefName = $this->ingredients[$ingredientName] ?? null)) {
            $rawIngredientRef = $this->ingredients[$ingredientRefName] ?? null;

            if (!$rawIngredientRef) {
                throw new UnknownIngredientException(
                    sprintf('Ingredient reference not found: "%s"', $ingredientRefName)
                );
            }

            $ingredientReference = $this->createIngredient(
                ingredientName   : $ingredientName,
                rawIngredient    : $rawIngredientRef,
                ingredientRefName: $ingredientRefName
            );

            return $this->createIngredient(
                ingredientName     : $ingredientRefName,
                rawIngredient      : $rawIngredientRef,
                ingredientReference: $ingredientReference
            );
        }

        return $this->createIngredient(
            $ingredientName,
            $rawIngredient
        );
    }

    /**
     * @param array<string, string> $rawIngredient
     */
    private function createIngredient(
        string $ingredientName,
        array $rawIngredient,
        ?string $ingredientRefName = null,
        ?Ingredient $ingredientReference = null
    ): Ingredient {
        $originalIngredient   = $this->ingredients[$ingredientRefName ?? $ingredientName] ?? [];
        $category             = $rawIngredient['kategoria'] ?? $originalIngredient['kategoria'] ?? null;
        $rawMeasurePreference = $rawIngredient['mertekegysegPreference']
                                ?? $originalIngredient['mertekegysegPreference']
                                   ?? $this->ingredientCategories[$category]['mertekegysegPreference']
                                      ?? null;

        $this->validateIngredientCategory(
            $ingredientName,
            $category,
            $rawIngredient['kategoria'],
            $originalIngredient['kategoria']
        );

        $measurePreference = $this->createMeasurePreference($ingredientName, $rawMeasurePreference);

        return new Ingredient(
            $ingredientName,
            $category,
            $measurePreference ?? null,
            $ingredientReference
        );
    }

    private function validateIngredientCategory(
        string $ingredientName,
        ?string $category,
        string $rawIngredientCategory,
        ?string $defaultIngredientCategory,
    ): void {
        if (!$category) {
            throw new UnknownIngredientException(
                sprintf('Ingredient not found: "%s"', $ingredientName)
            );
        }

        if ($category !== $defaultIngredientCategory) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient category mismatch for "%s": "%s" - "%s"',
                    $ingredientName,
                    $rawIngredientCategory,
                    $defaultIngredientCategory
                )
            );
        }

        if (!isset($this->ingredientCategories[$defaultIngredientCategory])) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient category not found for "%s": "%s"',
                    $ingredientName,
                    $defaultIngredientCategory
                )
            );
        }
    }

    private function createMeasurePreference(
        string $ingredientName,
        ?string $measurePreference = null
    ): ?Measure {
        $ingredientMeasurePreference = null;

        if ($measurePreference && !$ingredientMeasurePreference = Measure::tryFrom($measurePreference)) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient measurement not found for "%s": "%s"',
                    $ingredientName,
                    $measurePreference
                )
            );
        }

        return $ingredientMeasurePreference;
    }
}
