<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;

class IngredientToCategoryMap
{
    /**
     * @param array<string, string> $map
     */
    public function __construct(private readonly array $map)
    {
    }

    public function map(Hozzavalo $hozzavalo): string
    {
        $mappedKategoria = $this->map[$hozzavalo->name()] ?? null;

        if (!$mappedKategoria) {
            return $hozzavalo->kategoria();
        }

        return $mappedKategoria;
    }
}
