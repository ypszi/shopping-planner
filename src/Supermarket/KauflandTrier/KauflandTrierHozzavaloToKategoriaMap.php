<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;

class KauflandTrierHozzavaloToKategoriaMap extends HozzavaloToKategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    protected function hozzavaloMap(): array
    {
        return [
            'Ketchup' => KauflandTrierKategoria::HUTOS_UTAN,
            'Majonéz' => KauflandTrierKategoria::HUTOS_UTAN,
            'Mustár'  => KauflandTrierKategoria::HUTOS_UTAN,
            'Vaj'     => KauflandTrierKategoria::HUTOS_UTAN,
        ];
    }
}
