<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class Ingredient
{
    private string $name;

    private float $portion;

    private Measure $measure;

    private string $category;

    private ?Measure $measurePreference;

    public function __construct(
        string $name,
        float $portion,
        Measure $measure,
        string $category,
        ?Measure $measurePreference = null
    ) {
        $this->name              = $name;
        $this->portion           = $portion;
        $this->measure           = $measure;
        $this->category          = $category;
        $this->measurePreference = $measurePreference;
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

    public function withCategory(string $kategoria): self
    {
        $clone           = clone $this;
        $clone->category = $kategoria;

        return $clone;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function measurePreference(): ?Measure
    {
        return $this->measurePreference;
    }

    public function portion(): float
    {
        return $this->portion;
    }

    public function measure(): Measure
    {
        return $this->measure;
    }

    public function __toString(): string
    {
        return sprintf('%.2f %s %s', $this->portion, $this->measure->value, static::name());
    }
}
