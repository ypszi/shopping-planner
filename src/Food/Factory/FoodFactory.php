<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\Factory;

use PeterPecosz\ShoppingPlanner\Food\Exception\InvalidFoodException;
use PeterPecosz\ShoppingPlanner\Food\Exception\UnknownFoodException;
use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\TemplatingProcessor;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use Symfony\Component\Yaml\Yaml;

readonly class FoodFactory
{
    private const FOOD_TAG_COUNT_ALLOWED = 4;

    /** @var array<string, array<string, mixed>> */
    private array $foods;

    public function __construct(
        string $foodsPath,
        private ThumbnailFactory $thumbnailFactory,
        private TemplatingProcessor $templatingProcessor,
    ) {
        $this->foods = Yaml::parseFile($foodsPath);
    }

    /**
     * @param IngredientForFood[] $ingredients
     */
    public function createFood(string $foodName, array $ingredients, ?int $portion = null): Food
    {
        /** @var array<string, mixed> $rawFood */
        $rawFood = $this->foods[$foodName] ?? null;

        if (!isset($rawFood)) {
            throw new UnknownFoodException(sprintf('Food was not found: "%s"', $foodName));
        }

        $tags = $rawFood['tags'] ?? [];

        if (count($tags) > self::FOOD_TAG_COUNT_ALLOWED) {
            throw new InvalidFoodException(
                sprintf(
                    'Food has more tags than allowed (%d): "%s"',
                    self::FOOD_TAG_COUNT_ALLOWED,
                    $foodName
                )
            );
        }

        $food = new Food(
            name          : $foodName,
            defaultPortion: $rawFood['defaultPortion'],
            portion       : $portion,
            recipeUrl     : $rawFood['receptUrl'] ?? null,
            thumbnailUrl  : $rawFood['thumbnailUrl'] ?? null,
            tags          : $tags,
            comments      : $rawFood['comments'] ?? [],
            cookingSteps  : $rawFood['cookingSteps'] ?? [],
            ingredients   : $ingredients
        );

        $thumbnail = $this->thumbnailFactory->create($food);

        return $food
            ->withThumnailUrl($thumbnail?->getAssetPath())
            ->withComments($this->templatingProcessor->process($food, $rawFood['comments'] ?? []))
            ->withCookingSteps($this->templatingProcessor->process($food, $rawFood['cookingSteps'] ?? []));
    }
}
