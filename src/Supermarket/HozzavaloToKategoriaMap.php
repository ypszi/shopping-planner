<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

abstract class HozzavaloToKategoriaMap
{
    public function map(Hozzavalo $hozzavalo): Kategoria
    {
        $mappedKategoria = $this->hozzavaloMap()[$hozzavalo::name()] ?? null;

        if (!$mappedKategoria) {
            return $hozzavalo->kategoria();
        }

        return $mappedKategoria;
    }

    /**
     * @return array<string, Kategoria>
     */
    abstract protected function hozzavaloMap(): array;
}
