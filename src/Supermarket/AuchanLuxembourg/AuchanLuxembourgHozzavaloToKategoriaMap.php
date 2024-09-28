<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg;

use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;

class AuchanLuxembourgHozzavaloToKategoriaMap extends HozzavaloToKategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    protected function hozzavaloMap(): array
    {
        return [
            'Tojás'            => AuchanLuxembourgKategoria::TARTOS_TEJTERMEK,
            'Tonhal (konzerv)' => AuchanLuxembourgKategoria::NEMZETKOZI,
        ];
    }
}
