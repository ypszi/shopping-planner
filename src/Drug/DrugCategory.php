<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug;

readonly class DrugCategory
{
    public function __construct(
        private string $name,
        private int $storageMax,
        private int $storageStep
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function storageMax(): int
    {
        return $this->storageMax;
    }

    public function storageStep(): int
    {
        return $this->storageStep;
    }
}
