<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor;

use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;

class AuchanCsomorHozzavaloToKategoriaMap extends HozzavaloToKategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    protected function hozzavaloMap(): array
    {
        return [
            'Élesztő' => AuchanCsomorKategoria::TEJTERMEK,
        ];
    }
}
