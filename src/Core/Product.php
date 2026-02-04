<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core;

abstract class Product
{
    public function __construct(
        private readonly string $name,
        private ?string $thumbnailUrl = null,
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function thumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function withThumnailUrl(?string $thumbnailUrl): self
    {
        $clone               = clone $this;
        $clone->thumbnailUrl = $thumbnailUrl;

        return $clone;
    }
}
