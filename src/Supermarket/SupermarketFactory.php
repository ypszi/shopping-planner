<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Supermarket;

use PeterPecosz\ShoppingPlanner\Measure\MeasureConverter;
use PeterPecosz\ShoppingPlanner\Supermarket\Exception\UnknownSupermarketException;
use Symfony\Component\Yaml\Yaml;

readonly class SupermarketFactory
{
    /** @var array<string, string[]> */
    private array $supermarkets;

    public function __construct(string $supermarketsPath, private MeasureConverter $measureConverter)
    {
        $this->supermarkets = Yaml::parseFile($supermarketsPath);
    }

    public function create(string $name): Supermarket
    {
        if (!isset($this->supermarkets[$name])) {
            throw new UnknownSupermarketException(sprintf('Unknown supermarket: "%s"', $name));
        }

        $rawSupermarket = $this->supermarkets[$name];

        return new Supermarket(
            $name,
            $rawSupermarket['categories'],
            new CategoryMap($rawSupermarket['categoryMap']),
            $this->measureConverter,
            new IngredientToCategoryMap($rawSupermarket['ingredientMap'] ?? [])
        );
    }

    /**
     * @return string[]
     */
    public function listAvailableSupermarkets(): array
    {
        return array_keys($this->supermarkets);
    }
}
