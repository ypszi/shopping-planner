<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

class CategoryMap
{
    /**
     * @param array<string, string> $map
     */
    public function __construct(private readonly array $map)
    {
    }

    public function map(string $kategoria): string
    {
        $mappedKategoria = $this->map[$kategoria] ?? null;

        if (!isset($mappedKategoria)) {
            return $kategoria;
        }

        return $mappedKategoria;
    }
}
