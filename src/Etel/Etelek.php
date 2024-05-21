<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use ArrayIterator;
use IteratorAggregate;
use Override;
use Traversable;

/**
 * @template-implements IteratorAggregate<int, Etel>
 */
class Etelek implements IteratorAggregate
{
    /** @var Etel[] */
    private array $etelek;

    public function __construct(array $etelek = [])
    {
        $this->etelek = $etelek;
    }

    public function add(Etel $etel): self
    {
        $this->etelek[] = $etel;

        return $this;
    }

    /**
     * @return Etel[]
     */
    public function toArray(): array
    {
        return $this->etelek;
    }

    #[Override] public function getIterator(): Traversable
    {
        return new ArrayIterator($this->etelek);
    }
}
