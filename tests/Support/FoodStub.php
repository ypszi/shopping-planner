<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Support;

use Faker\Factory as Faker;
use PeterPecosz\ShoppingPlanner\Food\Food;

final class FoodStub
{
    /**
     * @var array{
     *     name: string,
     *     defaultPortion: string,
     *     portion: int|null,
     *     recipeUrl: string|null,
     *     thumbnailUrl: string|null,
     *     tags: array,
     *     comments: array,
     *     cookingSteps: array,
     *     ingredients: array,
     * }
     */
    private array $attributes;

    private function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public static function fake(array $attributes = []): self
    {
        $faker    = Faker::create();
        $defaults = [
            'name'           => $faker->word(),
            'defaultPortion' => $faker->randomNumber(1),
            'portion'        => null,
            'recipeUrl'      => null,
            'thumbnailUrl'   => null,
            'tags'           => [],
            'comments'       => [],
            'cookingSteps'   => [],
            'ingredients'    => [],
        ];

        return new self(array_merge($defaults, $attributes));
    }

    public function toObject(): Food
    {
        return new Food(
            name          : $this->attributes['name'],
            defaultPortion: $this->attributes['defaultPortion'],
            portion       : $this->attributes['portion'],
            recipeUrl     : $this->attributes['recipeUrl'],
            thumbnailUrl  : $this->attributes['thumbnailUrl'],
            tags          : $this->attributes['tags'],
            comments      : $this->attributes['comments'],
            cookingSteps  : $this->attributes['cookingSteps'],
            ingredients   : $this->attributes['ingredients'],
        );
    }
}
