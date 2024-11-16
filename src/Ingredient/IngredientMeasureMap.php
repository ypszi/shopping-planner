<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use Symfony\Component\Yaml\Yaml;

final class IngredientMeasureMap
{
    private const DEFAULT_MAX = 100;
    private const DEFAULT_STEP = 10;

    /** @var array<string, array{max: int, step: int}> */
    private array $mapByName;

    /** @var array<string, array{max: int, step: int}> */
    private array $mapByCategory;

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

        $this->mapByName = [];
        foreach ($this->ingredients as $ingredientName => $ingredient) {
            $storageSetup = $ingredient['storage'] ?? [];

            if (empty($storageSetup)) {
                continue;
            }

            $this->mapByName[$ingredientName] = [
                'max'  => $storageSetup['max'] ?? self::DEFAULT_MAX,
                'step' => $storageSetup['step'] ?? self::DEFAULT_STEP,
            ];
        }

        $this->mapByCategory = [];
        foreach ($this->ingredientCategories as $ingredientCategoryName => $ingredientCategory) {
            $storageSetup = $ingredientCategory['storage'] ?? [];

            $this->mapByCategory[$ingredientCategoryName] = [
                'max'  => $storageSetup['max'] ?? self::DEFAULT_MAX,
                'step' => $storageSetup['step'] ?? self::DEFAULT_STEP,
            ];
        }
    }

    /**
     * @return array<string, array{max: int, step: int}>
     */
    public function mapByName(): array
    {
        return $this->mapByName;
    }

    /**
     * @return array<string, array{max: int, step: int}>
     */
    public function mapByCategory(): array
    {
        return $this->mapByCategory;
    }
}
