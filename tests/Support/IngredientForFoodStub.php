<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Support;

use Faker\Factory as Faker;
use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

final class IngredientForFoodStub
{
    /**
     * @var array{
     *     name: string,
     *     category: string,
     *     portion: float,
     *     measure: Measure,
     *     measurePreference: Measure,
     *     reference: Ingredient,
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
            'name'              => $faker->word(),
            'category'          => $faker->word(),
            'portion'           => $faker->randomNumber(1),
            'measure'           => $faker->randomElement(Measure::cases()),
            'measurePreference' => null,
            'reference'         => null,
        ];

        return new self(array_merge($defaults, $attributes));
    }

    public function toObject(): IngredientForFood
    {
        return new IngredientForFood(
            name             : $this->attributes['name'],
            category         : $this->attributes['category'],
            portion          : $this->attributes['portion'],
            measure          : $this->attributes['measure'],
            measurePreference: $this->attributes['measurePreference'],
            reference        : $this->attributes['reference'],
        );
    }
}
