<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * @template-implements IteratorAggregate<int, Drug>
 */
class Drugs implements IteratorAggregate
{
    /** @var Drug[] */
    private array $drugs;

    public function __construct(array $drugs = [])
    {
        $this->drugs = $drugs;
    }

    public function add(Drug $drug): self
    {
        $this->drugs[] = $drug;

        return $this;
    }

    /**
     * @return Drug[]
     */
    public function toArray(): array
    {
        return $this->drugs;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->drugs);
    }
}
