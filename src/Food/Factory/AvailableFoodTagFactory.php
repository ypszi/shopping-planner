<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\Factory;

use Symfony\Component\Yaml\Yaml;

readonly class AvailableFoodTagFactory
{
    /** @var array<string, array<string, mixed>> */
    private array $foods;

    public function __construct(
        private FoodFactory $foodFactory,
        string $foodsPath
    ) {
        $this->foods = Yaml::parseFile($foodsPath);
    }

    /**
     * @return string[]
     */
    public function listAvailableFoodTags(): array
    {
        $availableFoodTags = [];

        foreach ($this->foods as $foodName => $food) {
            $food = $this->foodFactory->createFood(foodName: $foodName, ingredients: []);

            foreach ($food->tags() as $tag) {
                $availableFoodTags[] = $tag;
            }
        }

        return $this->sortTags(array_values(array_unique($availableFoodTags)));
    }

    /**
     * @param string[] $tags
     *
     * @return string[]
     */
    private function sortTags(array $tags): array
    {
        usort($tags, function (string $tag1, string $tag2) {
            return strnatcmp($tag1, $tag2);
        });

        return array_values($tags);
    }
}
