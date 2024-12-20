<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class IngredientForFood extends Ingredient
{
    private float $portion;

    private ?Measure $measure;

    public function __construct(
        string $name,
        string $category,
        float $portion,
        ?Measure $measure,
        ?Measure $measurePreference = null
    ) {
        $this->portion = $portion;
        $this->measure = $measure;

        parent::__construct($name, $category, $measurePreference);
    }

    public function withPortion(float $portion): self
    {
        $clone          = clone $this;
        $clone->portion = $portion;

        return $clone;
    }

    public function withMeasure(Measure $measure): self
    {
        $clone          = clone $this;
        $clone->measure = $measure;

        return $clone;
    }

    public function portion(): float
    {
        return $this->portion;
    }

    public function measure(): ?Measure
    {
        return $this->measure;
    }

    public function ingredientPortion(): string
    {
        return trim(sprintf('%.2f %s', $this->portion, $this->measure?->value ?? $this->measurePreference()->value));
    }

    public function __toString(): string
    {
        return trim(sprintf('%s %s', $this->ingredientPortion(), static::name()));
    }
}
