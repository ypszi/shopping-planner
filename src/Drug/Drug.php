<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug;

use PeterPecosz\ShoppingPlanner\Measure\Measure;

class Drug
{
    public function __construct(
        private readonly string $name,
        private readonly DrugCategory $category,
        private readonly int $defaultPortion,
        private readonly ?string $thumbnailUrl = null,
        private readonly ?Measure $measurePreference = null
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function category(): DrugCategory
    {
        return $this->category;
    }

    public function defaultPortion(): int
    {
        return $this->defaultPortion;
    }

    public function thumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
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
