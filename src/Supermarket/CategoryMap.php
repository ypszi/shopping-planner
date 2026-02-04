<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Supermarket;

readonly class CategoryMap
{
    /**
     * @param array<string, string> $map
     */
    public function __construct(private array $map)
    {
    }

    public function map(string $category): string
    {
        if (!isset($this->map[$category])) {
            return $category;
        }

        return $this->map[$category];
    }
}
