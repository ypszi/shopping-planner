<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Supermarket;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;

class IngredientToCategoryMap
{
    /**
     * @param array<string, string> $map
     */
    public function __construct(private readonly array $map)
    {
    }

    public function map(Ingredient $ingredient): string
    {
        $mappedCategory = $this->map[$ingredient->name()] ?? null;

        if (!$mappedCategory) {
            return $ingredient->category();
        }

        return $mappedCategory;
    }
}
