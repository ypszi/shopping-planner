<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug;

use PeterPecosz\ShoppingPlanner\Core\Product;
use PeterPecosz\ShoppingPlanner\Measure\Measure;

class Drug extends Product
{
    public function __construct(
        string $name,
        private readonly DrugCategory $category,
        private readonly int $defaultPortion,
        ?string $thumbnailUrl = null,
        private readonly ?Measure $measurePreference = null
    ) {
        parent::__construct($name, $thumbnailUrl);
    }

    public function category(): DrugCategory
    {
        return $this->category;
    }

    public function defaultPortion(): int
    {
        return $this->defaultPortion;
    }

    public function measurePreference(): ?Measure
    {
        return $this->measurePreference;
    }

    public function __toString(): string
    {
        return static::name();
    }
}
