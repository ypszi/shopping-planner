<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Supermarket\Exception\UnknownSupermarketException;
use Symfony\Component\Yaml\Yaml;

class SupermarketFactory
{
    /** @var array<string, string[]> */
    private readonly array $supermarkets;

    public function __construct(string $supermarketsPath)
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
