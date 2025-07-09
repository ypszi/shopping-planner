<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use PeterPecosz\ShoppingPlanner\Measure\Measure;

class IngredientForFood extends Ingredient
{
    private float $portion;

    private ?Measure $measure;

    public function __construct(
        string $name,
        string $category,
        float $portion,
        ?Measure $measure,
        ?Measure $measurePreference = null,
        ?Ingredient $reference = null
    ) {
        $this->portion = $portion;
        $this->measure = $measure;

        parent::__construct($name, $category, $measurePreference, $reference);
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
        $measure = $this->measure?->value ?? $this->measurePreference()->value;

        if ($this->portion == (int)$this->portion) {
            return sprintf('%d %s', $this->portion, $measure);
        }

        return sprintf(
            '%s %s',
            $this->humanReadablePrecision($this->portion),
            $measure
        );
    }

    public function __toString(): string
    {
        return trim(sprintf('%s %s', $this->ingredientPortion(), static::name()));
    }

    private function humanReadablePrecision(float $number): string
    {
        return rtrim(
            sprintf('%.2f', round($number, 2)),
            '0'
        );
    }
}
