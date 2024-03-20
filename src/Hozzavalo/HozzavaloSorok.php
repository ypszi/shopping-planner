<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

class HozzavaloSorok
{
    /** @var HozzavaloSor[] */
    private array $hozzavaloSorok;

    /**
     * @param HozzavaloSor[] $hozzavaloSorok
     */
    public function __construct(array $hozzavaloSorok = [])
    {
        $this->hozzavaloSorok = $hozzavaloSorok;
    }

    public function add(HozzavaloSor $hozzavaloSor): self
    {
        $this->hozzavaloSorok[] = $hozzavaloSor;

        return $this;
    }

    /**
     * @return HozzavaloSor[]
     */
    public function getAll(): array
    {
        return $this->hozzavaloSorok;
    }

    public function convert(): self
    {
        foreach ($this->hozzavaloSorok as $hozzavaloSor) {
            $hozzavaloSor->convert();
        }

        return $this;
    }

    /**
     * @return array<string[]>
     */
    public function toArray(): array
    {
        return array_map(fn(HozzavaloSor $hozzavaloSor) => $hozzavaloSor->toArray(), $this->hozzavaloSorok);
    }
}
