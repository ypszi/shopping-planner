<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use PeterPecosz\ShoppingPlanner\Measure\Measure;

class Ingredient
{
    private string $name;

    private string $category;

    private ?Measure $measurePreference;

    private ?Ingredient $reference;

    public function __construct(
        string $name,
        string $category,
        ?Measure $measurePreference = null,
        ?Ingredient $reference = null
    ) {
        $this->name              = $name;
        $this->category          = $category;
        $this->measurePreference = $measurePreference;
        $this->reference         = $reference;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function withCategory(string $category): self
    {
        $clone           = clone $this;
        $clone->category = $category;

        return $clone;
    }

    public function measurePreference(): ?Measure
    {
        return $this->measurePreference;
    }

    public function reference(): ?Ingredient
    {
        return $this->reference;
    }

    public function __toString(): string
    {
        return static::name();
    }
}
