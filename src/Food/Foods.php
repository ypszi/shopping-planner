<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * @template-implements IteratorAggregate<int, Food>
 */
class Foods implements IteratorAggregate
{
    /** @var Food[] */
    private array $foods;

    public function __construct(array $foods = [])
    {
        $this->foods = $foods;
    }

    public function add(Food $food): self
    {
        $this->foods[] = $food;

        return $this;
    }

    /**
     * @return Food[]
     */
    public function toArray(): array
    {
        return $this->foods;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->foods);
    }
}
