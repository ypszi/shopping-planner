<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use ArrayIterator;
use IteratorAggregate;
use Override;
use Traversable;

/**
 * @template-implements IteratorAggregate<string, Hozzavalo[]>
 */
class HozzavalokByKategoria implements IteratorAggregate
{
    /** @var array<string, Hozzavalo[]> */
    private array $hozzavalok;

    public function __construct(array $hozzavalok = [])
    {
        $this->hozzavalok = $hozzavalok;
    }

    /**
     * @param Hozzavalo[] $hozzavalok
     */
    public function addMultipleHozzavalo(array $hozzavalok): self
    {
        foreach ($hozzavalok as $hozzavalo) {
            $this->addHozzavalo($hozzavalo);
        }

        return $this;
    }

    #[Override] public function getIterator(): Traversable
    {
        return new ArrayIterator($this->hozzavalok);
    }

    private function addHozzavalo(Hozzavalo $hozzavalo): self
    {
        $this->hozzavalok[$hozzavalo->kategoria()->value()][] = $hozzavalo;

        return $this;
    }
}
