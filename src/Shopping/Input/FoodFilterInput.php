<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Shopping\Input;

readonly class FoodFilterInput
{
    public function __construct(
        private ?array $tags = null,
        private ?Operator $operator = null
    ) {
    }

    public function tags(): ?array
    {
        return $this->tags;
    }

    public function operator(): ?Operator
    {
        return $this->operator;
    }
}
