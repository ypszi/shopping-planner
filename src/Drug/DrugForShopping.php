<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug;

use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

class DrugForShopping extends Drug
{
    private float $portion;

    private ?Measure $measure;

    public function __construct(
        string $name,
        DrugCategory $category,
        float $portion,
        ?Measure $measure,
        ?Measure $measurePreference = null
    ) {
        $this->portion = $portion;
        $this->measure = $measure;

        parent::__construct($name, $category, $measurePreference);
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
