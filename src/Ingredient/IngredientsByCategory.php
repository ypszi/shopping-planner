<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * @implements IteratorAggregate<string, Ingredient[]>
 */
class IngredientsByCategory implements IteratorAggregate
{
    /** @var array<string, Ingredient[]> */
    private array $ingredients;

    public function __construct(array $ingredients = [])
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @param Ingredient[] $ingredients
     */
    public function addMultipleIngredients(array $ingredients): self
    {
        foreach ($ingredients as $ingredient) {
            $this->addIngredient($ingredient);
        }

        return $this;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->ingredients);
    }

    private function addIngredient(Ingredient $ingredient): self
    {
        $this->ingredients[$ingredient->category()][] = $ingredient;

        return $this;
    }
}
