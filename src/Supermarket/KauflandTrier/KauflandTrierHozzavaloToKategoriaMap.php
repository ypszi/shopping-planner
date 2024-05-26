<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\KauflandTrier;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Ketchup;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Majonez;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Mustar;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Vaj;
use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;

class KauflandTrierHozzavaloToKategoriaMap extends HozzavaloToKategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    #[Override] protected function hozzavaloMap(): array
    {
        return [
            Ketchup::name() => KauflandTrierKategoria::HUTOS_UTAN,
            Majonez::name() => KauflandTrierKategoria::HUTOS_UTAN,
            Mustar::name()  => KauflandTrierKategoria::HUTOS_UTAN,
            Vaj::name()     => KauflandTrierKategoria::HUTOS_UTAN,
        ];
    }
}
