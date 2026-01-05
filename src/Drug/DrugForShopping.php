<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug;

use PeterPecosz\ShoppingPlanner\Measure\Measure;

class DrugForShopping extends Drug
{
    public function __construct(
        string $name,
        DrugCategory $category,
        int $defaultPortion,
        private readonly float $portion,
        private readonly ?Measure $measure,
        ?string $thumbnailUrl = null,
        ?Measure $measurePreference = null
    ) {
        parent::__construct($name, $category, $defaultPortion, $thumbnailUrl, $measurePreference);
    }

    public function portion(): float
    {
        return $this->portion;
    }

    public function measure(): ?Measure
    {
        return $this->measure;
    }

    public function drugPortion(): string
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
        return trim(sprintf('%s %s', $this->drugPortion(), static::name()));
    }

    private function humanReadablePrecision(float $number): string
    {
        return rtrim(
            sprintf('%.2f', round($number, 2)),
            '0'
        );
    }
}
