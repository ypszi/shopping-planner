<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug;

use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class Drug
{
    private string $name;

    private DrugCategory $category;

    private ?Measure $measurePreference;

    public function __construct(
        string $name,
        DrugCategory $category,
        ?Measure $measurePreference = null
    ) {
        $this->name              = $name;
        $this->category          = $category;
        $this->measurePreference = $measurePreference;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function category(): DrugCategory
    {
        return $this->category;
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
