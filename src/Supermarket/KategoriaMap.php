<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

abstract class KategoriaMap
{
    public function map(Kategoria $kategoria): Kategoria
    {
        $mappedKategoria = $this->kategoriaMap()[$kategoria->value()] ?? null;

        if (!isset($mappedKategoria)) {
            return $kategoria;
        }

        return $mappedKategoria;
    }

    /**
     * @return array<string, Kategoria>
     */
    abstract protected function kategoriaMap(): array;
}
