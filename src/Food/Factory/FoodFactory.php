<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Exception\UnknownFoodException;
use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use Symfony\Component\Yaml\Yaml;

readonly class FoodFactory
{
    /** @var array<string, array<string, mixed>> */
    private array $foods;

    public function __construct(string $foodsPath)
    {
        $this->foods = Yaml::parseFile($foodsPath);
    }

    /**
     * @param Ingredient[] $ingredients
     */
    public function createFood(string $foodName, array $ingredients, ?int $portion = null): Food
    {
        /** @var array<string, mixed> $food */
        $food = $this->foods[$foodName] ?? null;

        if (!isset($food)) {
            throw new UnknownFoodException(sprintf('Food was not found: "%s"', $foodName));
        }

        return new Food(
            name:           $foodName,
            defaultPortion: $food['defaultPortion'],
            portion:        $portion,
            recipeUrl:      $food['receptUrl'] ?? null,
            thumbnailUrl:   $food['thumbnailUrl'] ?? null,
            comments:       $food['comments'] ?? [],
            ingredients:    $ingredients
        );
    }
}
